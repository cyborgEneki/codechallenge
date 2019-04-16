<template>
  <div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Books</span>
        <router-link :to="{ name: 'addBook' }">
          <i class="fas fa-plus-circle add-icon"></i>
        </router-link>
      </div>
      <table>
        <thead>
          <tr>
            <th width="22.5%">Title</th>
            <th width="22.5%">Status</th>
            <th width="22.5%">Reserved By</th>
            <th width="22.5%">Category</th>
            <th class="actions-column">Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="book in books" :key="book.id">
            <td>{{ book.title }}</td>
            <td>{{ book.status }}</td>
            <td>{{ book.reservor_id }}</td>
            <td>{{ book.category_id }}</td>
            <td>
              <i class="far fa-eye icon green"></i>
              <i class="fas fa-edit icon blue"></i>
              <i class="fas fa-trash-alt icon red"></i>
            </td>
          </tr>
        </tbody>
      </table>
      <pagination :meta_data="meta_data" @next="getBooks"></pagination>
    </el-card>
    <router-view></router-view>
  </div>
</template>

<script>
import Pagination from "../pagination";

export default {
  components: { Pagination },
  data() {
    return {
      books: [],
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      }
    };
  },
  methods: {
    getBooks(page = 1) {
      axios
        .get("/api/books/", {
          params: {
            page
          }
        })
        .then(res => {
          this.books = res.data.data;
          this.meta_data.last_page = res.data.last_page;
          this.meta_data.current_page = res.data.current_page;
          this.meta_data.prev_page_url = res.data.prev_page_url;
        });
    }
  },
  mounted() {
    this.getBooks();
  }
};
</script>

<style>
</style>