<template>
  <div>
    <el-card v-if="isadmin" class="box-card">
      <div slot="header">
        <span class="card-font">Users</span>
        <router-link :to="{ name: 'addUser' }">
          <i class="fas fa-plus-circle add-icon"></i>
        </router-link>
      </div>
      <table class="font-14">
        <thead>
          <tr>
            <th width=15%>First Name</th>
            <th width=15%>Last Name</th>
            <th width=15%>Email</th>
            <th width=15% class="center">Maximum Number of Books Allowed</th>
            <th width=15%>Status</th>
            <th width=15%>Department</th>
            <th class="actions-column">Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td width=15%>{{ user.first_name }}</td>
            <td width=15%>{{ user.last_name }}</td>
            <td width=15%>{{ user.email }}</td>
            <td width=15% class="center">{{ user.max_number_of_books_allowed }}</td>
            <td width=15%>
              <p v-if="user.status == 1">Active</p>
              <p v-if="user.status == 0">Suspended</p>
            </td>
            <td width=15%>{{ choices.departments[user.department_id].name }}</td>
            <td class="actions-column">
              <router-link :to="{ name: 'editUser', params: { user } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <a>
                <i class="fas fa-trash-alt icon red" @click="deleteUser(user.id)"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :meta_data="meta_data" @next="getUsers"></pagination>
    </el-card>
    <router-view></router-view>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  props: ["choices"],
  components: { Pagination },
  data() {
    return {
      users: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      },
      isadmin: false
    };
  },
  methods: {
    getUsers(page = 1) {
      axios
        .get("/api/users/", {
          params: {
            page
          }
        })
        .then(res => {
          this.users = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    },
    deleteUser(id) {
      this.$confirm(
        "This will permanently delete the user. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          axios.delete("/api/users/" + id).then(() => {
            let index = this.users
              .map(item => {
                return item.id;
              })
              .indexOf(id);
            this.users.splice(index, 1);
            this.$notify({
              title: "Success",
              message: "The user has been deleted",
              type: "success"
            });
          });
        })
        .catch(() => {
          this.$notify.info({
            title: "Info",
            message: "Delete cancelled"
          });
        });
    },
    getAdmin() {
      axios.get("/api/users/isadmin").then(response => {
        this.isadmin = response.data;
      });
    }
  },
  created() {
    this.getUsers();
    this.getAdmin();
  }
};
</script>

<style>
.center {
  text-align: center;
}
</style>