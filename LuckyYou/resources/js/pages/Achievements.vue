<template>
    <div id="app">
        <p>Achievement menu:</p>
        <div>
            <router-link to="/achievements" tag="button" class="btn btn-primary">All achievements</router-link>
            <router-link to="/user-achievements" tag="button" v-on="checkAchievs()" class="btn btn-secondary">my achievements</router-link>
        </div>

      <table class="table">
        <thead>
        <tr>
          <th>Requirement</th>
          <th>Reward</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="achievement in achievements">
          <td v-if="achievement.type === 0">{{ achievement.requirement }} balance</td>
          <td v-if="achievement.type === 1">{{ achievement.requirement }} game wins</td>
          <td>{{ achievement.reward }}</td>
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
            achievements: [],
        }
    },
    created() {
        axios.get('/api/achievements').then((res) =>{
            this.achievements = res.data;
        }).catch((error) =>{
            console.log(error.response.data)
        })
    },
  methods:{
      checkAchievs(){
          axios.post('/api/checkAchiev', this.form).then((res)=>{
            console.log(res);
          }).catch(err =>  {
            this.errors = err.response.data.errors
            console.log(this.errors)
          })
        }
      }
}
</script>
