<template>
  <div>
    <AppHeader/>

    <div class="container">

      <h3> All Fruits </h3>  <br>
    <form>
      <div class="form-group">
        <label>Name:</label>
        <input v-model="filters.name" class="form-control">
      </div>
      <div class="form-group">
        <label>Family:</label>
        <input v-model="filters.family" class="form-control">
      </div>
      <button type="button" class="btn btn-primary" @click="applyFilters">Filter</button>
    </form>

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
        <td> <button @click="addToFavAction(fruit)"  class="btn btn-sm btn-success" > Add to Favourite </button> *   </td>
      </tr>
      </tbody>
    </table>

    <nav v-if="pagination.last_page >1">
      <ul class="pagination">
        <li v-if="pagination.current_page > 1">
          <a @click.prevent="changePage(pagination.current_page - 1)" href="#">Previous</a>
        </li>

        <li v-for="page in pagination.last_page" :key="page" :class="{'active': page === pagination.current_page}">
          <a @click.prevent="changePage(page)" href="#">{{ page }}</a>
        </li>

        <li v-if="pagination.current_page < pagination.last_page">
          <a @click.prevent="changePage(pagination.current_page + 1)" href="#">Next</a>
        </li>
      </ul>
    </nav>
  </div>
  </div>
</template>

<script>
import axios from "axios";
import AppHeader from "../components/AppHeader.vue";
export default {
  components: { AppHeader},
  name: "listing" ,
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
    addToFavAction(data){
      axios.post('http://localhost:8000/fruits/add-to-fav' ,data).then(response=>{
        console.log(response)
        if (response.data.success){
          alert(response.data.message)
        }else{
          alert('Failed to save to favourites '  + response.data.message)
        }
      })
    },
    fetchFruits(page = 1) {
      const filters = {
        page: page,
        name: this.filters.name,
        family: this.filters.family,
      };

      axios.get('http://localhost:8000/fruits/list', { params: filters })
        .then(response => {
          console.log(response)
        this.fruits = response.data.data.fruits;
        this.pagination = response.data.data.pagination;
        this.currentPage = this.pagination.current_page;
      });
    },

    changePage(page) {
      this.fetchFruits(page);
    },

    applyFilters() {
      this.fetchFruits();
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
