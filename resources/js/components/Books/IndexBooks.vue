<template>
  <div>
    <div class="search-wrapper panel-heading col-sm-12">
      <input class="form-control" type="text" v-model="searchQuery" placeholder="Search">
    </div>
    <el-card class="box-card">
      <div slot="header">
        <span class="card-font">Books</span>
        <router-link v-if="isadmin" :to="{ name: 'addBook' }">
          <i class="fas fa-plus-circle add-icon"></i>
        </router-link>
      </div>
      <table class="font-14">
        <thead>
          <tr>
            <th width="20%">Title</th>
            <th width="20%">Author</th>
            <th width="20%">Status</th>
            <th width="20%">Category</th>
            <th width="20%" v-show="choices.authuserstatus == 1">Options</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="book in filteredBooks" :key="book.id">
            <td>{{ book.title }}</td>
            <td>{{ book.author }}</td>
            <td>
              <p v-if="book.status == 1">Available</p>
              <p v-if="book.status == 0">Borrowed</p>
            </td>
            <td>{{ choices.categories[book.category_id].name }}</td>
            <td v-show="choices.authuserstatus == 1">
              <router-link v-if="isadmin" :to="{ name: 'editBook', params: { book, id: book.id } }">
                <i class="fas fa-edit icon blue"></i>
              </router-link>
              <a v-if="isadmin">
                <i class="fas fa-trash-alt icon red" @click="deleteBook(book.id)"></i>
              </a>
              <el-button class="borrow-button" v-show="book.status == 1" @click="borrow(book.id)">Borrow</el-button>
              <el-button
                class="reserve-button"
                v-if="book.status == 0"
                v-show="book.reservor_id == null"
                @click="reserve(book.id)"
              >Reserve</el-button>
              <el-button v-if="isadmin" v-show="book.status == 0" @click="returned(book.id)">Return</el-button>
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
  props: ["choices"],
  components: { Pagination },
  computed: {
    orderedAuthors() {
      return _.orderBy(this.choices.authors, "name");
    },
    filteredBooks() {
      if (this.searchQuery) {
        return this.books.filter(item => {
          return item.title.startsWith(this.searchQuery);
        });
      } else {
        return _.orderBy(this.books, "created_at", "desc");
      }
    }
  },
  data() {
    return {
      books: [],
      searchQuery: "",
      meta_data: {
        last_page: null,
        current_page: 1,
        prev_page_url: null
      },
      isadmin: false,
      borrowDetails: {
        due_date: "",
        date_out: "",
        book_id: "",
        user_id: ""
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
    },
    deleteBook(id) {
      this.$confirm(
        "This will permanently delete the book. Continue?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      )
        .then(() => {
          axios.delete("/api/books/" + id).then(() => {
            let index = this.books
              .map(item => {
                return item.id;
              })
              .indexOf(id);
            this.books.splice(index, 1);
            this.$notify({
              title: "Success",
              message: "The book has been deleted",
              type: "success",
              duration: 10000
            });
          });
        })
        .catch(() => {
          this.$notify.info({
            title: "Info",
            message: "Delete cancelled",
            duration: 10000
          });
        });
    },
    getAdmin() {
      axios.get("/api/users/isadmin").then(response => {
        this.isadmin = response.data;
      });
    },
    borrow(id) {
      this.$confirm(
        "Are you sure that this is the book you want to borrow?",
        "Confirmation",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      ).then(() => {
        this.borrowDetails.book_id = id;
        console.log(id);
        axios
          .post("/api/borrow", this.borrowDetails)
          .then(response => {
            this.$notify({
              title: "Success",
              message: "Success! Kindly go pick up your book from HR. Refresh the page and visit your profile to see the due date.",
              type: "success",
              duration: 30000
            });
          })
          .catch(() => {
            this.$alert("You have exceeded your borrowing limit. Kindly return at least one book to borrow this one", "Stop", {
              confirmButtonText: "OK"
            });
          });
      });
    },
    reserve(id) {
      this.$confirm(
        "Are you sure that this is the book you want to reserve?",
        "Warning",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      ).then(() => {
        axios
          .get("/api/books/" + id + "/reserve", this.books)
          .then(response => {
            this.books = response.data;
            this.$alert(
              "You will get an email notification as soon as this book is available. Please note that it will be unchecked in the system as soon as the email is sent, therefore, kindly borrow it as soon as you receive the email.",
              "Success!",
              {
                confirmButtonText: "OK",
                callback: action => {}
              }
            );
          });
      });
    },
    returned(id) {
      this.$confirm(
        "Are you sure you have seen this specific book?",
        "Confirmation",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancel",
          type: "warning"
        }
      ).then(() => {
        axios
          .get("/api/books/" + id + "/returned", this.books)
          .then(response => {
            this.books = response.data;
            this.$notify({
              title: "Success",
              message: "The book has been returned to the shelf. Refresh the page to see the borrow option",
              type: "success",
              duration: 30000
            });
          });
      });
    }
  },
  created() {
    this.getBooks();
    this.getAdmin();
  }
};
</script>

<style>
.borrow-button {
  background-color: lightgreen;
}
.reserve-button {
  background-color: yellow;
}
</style>