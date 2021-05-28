<template>
    <div id="app">
        <p></p>
        <p>Admin menu:</p>

        <table class="table">
          <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Balance</th>
            <th>Actions</th>
            <th>Give money</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="user in users">
              <td>{{ user.id }}</td>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role }}</td>
              <td>{{ user.balance }}</td>
              <td>
                <a href="#" class="btn btn-primary" v-if="user.role != 'admin'" @click="ChangeRole(user.id)">Make admin</a>
                <a href="#" class="btn btn-danger" v-if="user.role != 'admin'" @click="DeleteUser(user.id)">Delete</a>
                <a href="#" class="btn btn-danger disabled" aria-disabled="true" v-if="user.role === 'admin'" @click="DeleteUser(user.id)">Delete</a>
              <td style='width:120px'> <input id="money" class="form-control" v-model="money" placeholder="100" type="number" style='width:120px' name="money"></input> </td>
              <td> <a href="#"  class="btn btn-primary" @click="AddMoney(user.id)">Give</a> </td>
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
            money: null,
            user: null,
            users: [],
        }
    },
    created() {
      this.get();
    },
    methods: {
      get() {
        axios.get('/api/users', this.form).then((res) =>{
          this.users = res.data;
        }).catch((error) =>{
          console.log(error.response.data)
        })
      },
      DeleteUser(id) {
        axios.post('/api/userDelete', {
          user: id,
        })
            .then(function (response) {
              console.log(response);
              location.reload();
            })
            .catch(function (error) {
              console.log(error.response.data);
            });
      },
      AddMoney(id) {
        axios.post('/api/giveMoney', {
          user: id,
          moneyy: this.money
        })
            .then(function (response) {
              console.log(response);
             // location.reload();
            })
            .catch(function (error) {
              console.log(error.response.data);
            });
      },
      ChangeRole(id) {
        axios.post('/api/changeRole', {
          user: id,
        })
            .then(function (response) {
              console.log(response);
               location.reload();
            })
            .catch(function (error) {
              console.log(error.response.data);
            });
      },
    }
}
</script>
