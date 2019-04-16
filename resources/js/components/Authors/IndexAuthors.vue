<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Authors</span>
        <router-link :to="{ name: 'addAuthor' }">
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
          <tr v-for="author in authors" :key="author.id">
            <td width="90%">{{ author.name }}</td>
            <td>
              <i class="far fa-eye icon green"></i>
              <router-link :to="{ name: 'editAuthor', params: { author } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <a>
                <i class="fas fa-trash-alt icon red" @click="deleteAuthor(author.id)"></i>
              </a>
            </td>
          </tr>
        </tbody>
      </table>
      <router-view></router-view>
      <pagination :meta_data="meta_data" @next="getAuthors"></pagination>
    </el-card>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  components: { Pagination },
  data() {
    return {
      authors: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      }
    };
  },
  methods: {
    getAuthors(page = 1) {
      axios
        .get("/api/authors/", {
          params: {
            page
          }
        })
        .then(res => {
          this.authors = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    },
    deleteAuthor(id) {
      this.$confirm(
        "This will permanently delete the file. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          axios.delete("/api/authors/" + id).then(() => {
            let index = this.authors
              .map(item => {
                return item.id;
              })
              .indexOf(id);
            this.authors.splice(index, 1);
            this.$notify({
              title: "Success",
              message: "The author name has been deleted",
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
    created() {
      this.getAuthors();
    }
  }
};
</script>

<style>
.pagination {
  text-align: center;
}
.icon {
  padding: 10px;
}
.actions-column {
  width: "10%";
  text-align: center;
}
.el-card__body {
  background: #eacdcd;
}
.card-font {
  font-size: 28px;
}
tbody tr:nth-child(even) {
  background-color: #f3eaea;
}
.add-icon {
  float: right;
  margin: 5px 5px 0px 0px;
  font-size: 35px;
  color: #5f0e0e;
}
</style>