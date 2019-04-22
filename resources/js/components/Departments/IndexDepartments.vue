<template>
  <div>
    <el-card v-if="isadmin" class="box-card">
      <div slot="header">
        <span class="card-font">Departments</span>
        <router-link :to="{ name: 'addDepartment' }">
          <i class="fas fa-plus-circle add-icon"></i>
        </router-link>
      </div>
      <table class="font-14">
        <thead>
          <tr>
            <th width="90%">Name</th>
            <th class="actions-column">Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="department in orderedDepartments" :key="department.id">
            <td width="90%">{{ department.name }}</td>
            <td class="actions-column">
              <router-link
                :to="{ name: 'editDepartment', params: { department, id: department.id } }"
              >
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <a>
                <i class="fas fa-trash-alt icon red" @click="deleteDepartment(department.id)"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <router-view></router-view>
      <pagination :meta_data="meta_data" @next="getDepartments"></pagination>
    </el-card>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  components: { Pagination },
  computed: {
    orderedDepartments() {
      return _.orderBy(this.departments, "created_at", "desc");
    }
  },
  data() {
    return {
      departments: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      },
      isadmin: false
    };
  },
  methods: {
    getDepartments(page = 1) {
      axios
        .get("/api/departments/", {
          params: {
            page
          }
        })
        .then(res => {
          this.departments = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    },
    deleteDepartment(id) {
      this.$confirm(
        "Are there users listed under this department? If yes, remove them or change their department to delete this department.",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      ).then(() => {
        axios
          .delete("/api/departments/" + id)
          .then(() => {
            let index = this.departments
              .map(item => {
                return item.id;
              })
              .indexOf(id);
            this.departments.splice(index, 1);
            this.$notify({
              title: "Success",
              message: "The department has been deleted",
              type: "success",
              duration: 10000
            });
          })
          .catch(() => {
            this.$alert(
              "There are users attached to this department. Remove them or change their department to delete this department",
              "Stop",
              {
                confirmButtonText: "OK"
              }
            );
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
    this.getDepartments();
    this.getAdmin();
  }
};
</script>

<style>
</style>

<style>
</style>