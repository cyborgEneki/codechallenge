<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Categories</span>
        <router-link :to="{ name: 'addCategory' }">
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
          <tr v-for="category in categories" :key="category.id">
            <td width="90%">{{ category.name }}</td>
            <td class="actions-column">
              <router-link :to="{ name: 'editCategory', params: { category } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <a>
                <i class="fas fa-trash-alt icon red" @click="deleteCategory(category.id)"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <router-view></router-view>
      <pagination :meta_data="meta_data" @next="getCategories"></pagination>
    </el-card>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  components: { Pagination },
  data() {
    return {
      categories: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      }
    };
  },
  methods: {
    getCategories(page = 1) {
      axios
        .get("/api/categories/", {
          params: {
            page
          }
        })
        .then(res => {
          this.categories = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    },
    deleteCategory(id) {
      this.$confirm(
        "This will permanently delete the category. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          axios.delete("/api/categories/" + id).then(() => {
            let index = this.categories
              .map(item => {
                return item.id;
              })
              .indexOf(id);
            this.categories.splice(index, 1);
            this.$notify({
              title: "Success",
              message: "The category has been deleted",
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
    this.getCategories();
  }
};
</script>

<style>
</style>