<template>
  <div>
    <el-card v-if="isadmin" class="box-card">
      <div slot="header">
        <span class="card-font">Access Levels</span>
      </div>
      <table class="font-14">
        <thead>
          <tr>
            <th width="90%">Name</th>
            <th>Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="accesslevel in accesslevels" :key="accesslevel.id">
            <td width="90%">{{ accesslevel.name }}</td>
            <td>
              <router-link :to="{ name: 'editAccesslevel', params: { accesslevel } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
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
      },
      isadmin: false
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
    getAdmin() {
      axios.get("/api/users/isadmin").then(response => {
        this.isadmin = response.data;
      });
    }
  },
  created() {
    this.getAccesslevels();
    this.getAdmin();
  }
};
</script>

<style>
</style>

<style>
</style>