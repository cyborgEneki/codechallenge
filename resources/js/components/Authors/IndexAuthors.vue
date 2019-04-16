<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Authors</span>
      </div>
      <table>
        <tbody>
          <tr v-for="author in authors" :key="author.id">
            <td width="90%">{{ author.name }}</td>
            <td>
              <i class="far fa-eye icon green"></i>
              <i class="fas fa-edit icon blue"></i>
              <i class="fas fa-trash-alt icon red"></i>
            </td>
          </tr>
        </tbody>
      </table>
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
    }
  },
  created() {
    this.getAuthors();
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
  font-size: 30px;
}
tbody tr:nth-child(even) {
    background-color: #f3eaea;
}
</style>