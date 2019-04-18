<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Access Levels</span>
        <router-link :to="{ name: 'addAccesslevel' }">
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
          <tr v-for="accesslevel in accesslevels" :key="accesslevel.id">
            <td width="90%">{{ accesslevel.name }}</td>
            <td>
              <router-link :to="{ name: 'editAccesslevel', params: { accesslevel } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <a>
                <i class="fas fa-trash-alt icon red" @click="deleteAccesslevel(accesslevel.id)"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <router-view></router-view>
      <pagination :meta_data="meta_data" @next="getAccesslevels"></pagination>
    </el-card>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  components: { Pagination },
  data() {
    return {
      accesslevels: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      }
    };
  },
  methods: {
    getAccesslevels(page = 1) {
      axios
        .get("/api/accesslevels/", {
          params: {
            page
          }
        })
        .then(res => {
          this.accesslevels = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    },
    deleteAccesslevel(id) {
      this.$confirm(
        "This will permanently delete the access level. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          axios.delete("/api/accesslevels/" + id).then(() => {
            let index = this.accesslevels
              .map(item => {
                return item.id;
              })
              .indexOf(id);
            this.accesslevels.splice(index, 1);
            this.$notify({
              title: "Success",
              message: "The access level has been deleted",
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
    }
  },
  created() {
    this.getAccesslevels();
  }
};
</script>

<style>
</style>

<style>
</style>