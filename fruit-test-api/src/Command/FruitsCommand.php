<?php

namespace App\Command;

use App\Service\FruitsService;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\SendmailTransport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;


#[AsCommand(
    name: 'fruits:fetch',
    description: 'Add a short description for your command',
)]
class FruitsCommand extends Command
{

    public function __construct(private FruitsService $fruitsService)
    {
        parent::__construct();
    }

    //
    protected function configure(): void
    {
        $this
            ->setName('FruitsCommand')
            ->setDescription('Fetch fruits from API and save to database')
            ->addOption('env-file', null, InputOption::VALUE_REQUIRED, 'Path to .env file');
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws TransportExceptionInterface
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $httpClient = HttpClient::create();
        try {
            $response = $httpClient->request('GET', 'https://fruityvice.com/api/fruit/all');
            $statusCode = $response->getStatusCode();
            echo $statusCode . "\n";
            if ($statusCode !== 200) {
                $output->write("Failed to get fruit from remote source, try again letter ");
                return Command::FAILURE;
            } else {
                $content = $response->getContent();
                // echo $content . "\n";

                $fruitsData = json_decode($content, true);
                foreach ($fruitsData as $fruitData) {
                    $id = $this->fruitsService->saveFruit($fruitData);
                    $output->writeln("Saved fruit with id $id successfully");
                }
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

        try {
            $email = (new Email())
                ->from('kinsleykajiva@hmail.com')
                ->to('kajivakinsley@gmail.com')
                ->priority(Email::PRIORITY_HIGHEST)
                ->subject('Got New fruits,found')
                ->text('The are new Fruits saved in the database')
                ->html('<strong>The are new Fruits saved in the database!</strong>');
            $transport = new SendmailTransport();
            $mailer = new Mailer($transport);
            $mailer->send($email);
            // dump($email);
        } catch (\Exception|\Symfony\Component\Mailer\Exception\TransportExceptionInterface $exception) {
            echo $exception->getMessage();
        }


        // read from  the database
        $fruits = $this->fruitsService->getAllFruits();
        $output->write(json_encode($fruits, JSON_PRETTY_PRINT));


        return Command::SUCCESS;
    }
}
