<template>
  <div id="app">
    <p>Achievement menu:</p>
    <div>
      <router-link to="/achievements" tag="button" class="btn btn-primary">All achievements</router-link>
      <router-link to="/user-achievements" tag="button" class="btn btn-secondary">my achievements</router-link>
    </div>
    <p></p>

    <table class="table">
      <thead>
      <tr>
        <th>Claimed</th>
        <th>Date when achieved</th>
        <th>Claim</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="achievement in achievements">
        <td>{{ achievement.claimed ? 'Claimed' : 'Not claimed' }}</td>
        <td>{{ achievement.created_at }}</td>
        <td>
          <a v-if="achievement.claimed === 0" href="#" class="btn btn-primary" @click="claimReward(achievement.achievement_id, achievement.id)">Claim reward</a>
          <a v-if="achievement.claimed === 1" aria-disabled="true"  href="#" class="btn btn-primary disabled" @click="claimReward(achievement.achievement_id, achievement.id)">Claim reward</a> <td>
      </td>
        </td>
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
    this.get()
  },
  methods: {
    get() {
      axios.get('/api/user-achievements').then((res) =>{
        this.achievements = res.data;
      }).catch((error) =>{
        console.log(error.response.data)
      })
    },
    claimReward(achievement_id, id) {
      axios.post('/api/update-user-achievement', {
        achievement: achievement_id,
        id: id,
      })
      .then(function (response) {
        console.log(id);
        location.reload();
      })
      .catch(function (error) {
        console.log(id);
        console.log(error);
      });
    }
  }
}
</script>
