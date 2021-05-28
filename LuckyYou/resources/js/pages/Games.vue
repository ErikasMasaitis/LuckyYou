<template>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-header">Games</div>
                <div class="card">

                    <div class="card-body">
                      <p> Choose your looby and go play:</p>
                      <p v-if="!id" v-for="lobby in lobbies">
                        <router-link :to="{ name: 'games', params: { id: lobby.id }}" tag="button" class="btn btn-primary"> {{ lobby.lobby_name }} game, staking: {{ lobby.prize}}, winnings: {{ lobby.prize*10}}</router-link>
                      </p>
                         </div>
                  <div v-if="id">
                    <p v-if="userz"> <b> Your balance is: </b> {{userz.balance}}</p>
                    <p v-else> <b> Your balance is:</b> {{user.balance}}</p>
                    <div v-if="lost === 'true'" class="alert alert-danger" role="alert">
                      You lost !
                    </div>
                    <div v-if="lost === 'nomoney'" class="alert alert-danger" role="alert">
                      Your balance is too low
                    </div>
                    <div v-if="lost === 'false'" class="alert alert-success" role="alert">
                      You won !
                    </div>
                    <div>
                    <p>select number (1-10):</p>
                    <div class="p-2 w-full">
                      <label for="number">Your number:</label>
                      <input class="form-control" placeholder="number" id="number" type="number" min="1" max="10" v-model="number" name="number">
                    </div>
                    <div class="p-2 w-full mt-4">
                      <button @click="saveStake()" type="submit" class="btn btn-primary">Stake</button>
                    </div>
                    </div>
                  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      userz: null,
      balance: 'show',
      number: null,
      lost: 'notfals',
      randomNumber: null,
      id: this.$route.params.id, //this is the id from the browser
      data: {}
    }
  },
    props: {
        user: null,
        lobbies: [],
    },
  created() {
      this.get();
  },
    methods: {
      generate() {
        this.randomNumber = Math.ceil(Math.random()*10)
        return this.randomNumber;
      },
      update() {
        axios.get('/api/updateuser').then((res) =>{
          this.userz = res.data;
        }).catch((error) =>{
          console.log(error.response.data)
        })
      },
      get() {
        axios.get('/api/getlobbies', this.form).then((res) =>{
          this.lobbies = res.data;
        }).catch((error) =>{
          console.log(error.response.data)
        })
      },
      post() {
        axios.post('/api/stake', {
          id: this.id,
          decision: this.lost
            }
        ).then((res) =>{
          if(res.data == 'no money') {
            this.balance = 'show';
            this.lost='nomoney';
          }
          this.update();
        }).catch((error) =>{
          this.lost = 'nomoney';
          console.log(error.response.data)
        })
      },
      saveStake() {
        var a = this.generate();
        this.balance = 'notshow';
        if (this.number == a) {
          this.lost = 'false';
          this.post();
        }
        else {
          this.lost = 'true'
          this.post();
        }
      }
    }
}
</script>
