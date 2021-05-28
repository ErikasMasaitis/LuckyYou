<template>
  <div id="app">
    <p></p>
    <p>History menu:</p>

    <table class="table table-responsive table-sm table-striped">
      <thead>
      <tr>
        <th>Who won</th>
        <th>GOL</th>
        <th>Played at</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="histor in history">
        <td>{{ histor.winner ? 'You' : 'Computer' }}</td>
        <td>{{ histor.gol }}</td>
        <td >{{ histor.created_at }}</td>
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
      axios.get('/api/userwinningshistory').then((res) =>{
        this.history = res.data;
      }).catch((error) =>{
        console.log(error.response.data)
      })
    },
  }
}
</script>
