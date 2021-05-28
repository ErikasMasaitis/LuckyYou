<template>
  <div id="app">
    <p></p>
    <p>History menu:</p>

    <table class="table table-responsive table-sm table-striped">
      <thead>
      <tr>
        <th>Given to user</th>
        <th>given sum</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="histor in history">
        <td>{{ histor.email }}</td>
        <td>{{ histor.given_sum }}</td>
      </tr>
      </tbody>

    </table>
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  data(){
    return {
      user: null,
      history: [],
    }
  },
  created() {
    this.get();
  },
  methods: {
    get() {
      axios.get('/api/gethistory').then((res) =>{
        this.history = res.data;
      }).catch((error) =>{
        console.log(error.response.data)
      })
    },
  }
}
</script>
