<template>
  <div>
    <AppHeader/>

    <div class="container">

      <h3> All Favorite </h3>  <br>

      <table class="table">
        <thead>
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Genus</th>
          <th>Family</th>
          <th>Order</th>
          <th>Carbohydrates</th>
          <th>Protein</th>
          <th>Fat</th>
          <th>Calories</th>
          <th>Sugar</th>
          <th>Favourite Status Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="fruit in fruits" :key="fruit.id">
          <td>{{ fruit.id }}</td>
          <td>{{ fruit.name }}</td>
          <td>{{ fruit.genus }}</td>
          <td>{{ fruit.family }}</td>
          <td>{{ fruit.order }}</td>
          <td>{{ fruit.nutritions.carbohydrates }}</td>
          <td>{{ fruit.nutritions.protein }}</td>
          <td>{{ fruit.nutritions.fat }}</td>
          <td>{{ fruit.nutritions.calories }}</td>
          <td>{{ fruit.nutritions.sugar }}</td>
          <td>
            <button @click="deleteAction(fruit.id)" class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
        </tbody>
      </table>


    </div>
  </div>
</template>

<script>
import axios from "axios";
import AppHeader from "../components/AppHeader.vue";

export default {
  components: {AppHeader},
  name: "aboutfav",
  data() {
    return {
      filters: {
        name: '',
        family: '',
      },
      fruits: [],
      pagination: {},
      currentPage: 1,
    };
  },

  methods: {
    deleteAction(id) {
      if (window.confirm("Are you sure about Deleting?")) {
        axios.post('http://localhost:8000/fruits/delete-from-fav', {id})
          .then(response => {
            console.log(response)
            alert(response.data.message);
            if(response.data.success){
              this.fetchFruits();
            }

          })
          .catch(error => {
            console.log(error)
          });
      }
    },
    fetchFruits() {


      axios.get('http://localhost:8000/fruits/list-favs',)
        .then(response => {
          console.log(response)
          this.fruits = response.data.data.fruits;

        });
    },


  },

  mounted() {
    this.fetchFruits();
  },
}
</script>

<style>
.container {
  justify-content: center;
  align-items: center;
  height: 100%;
}

select {
  display: block;
  width: 40%;
  height: 3rem;
  padding: 0.5rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

select:focus {
  border-color: #80bdff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}


</style>
