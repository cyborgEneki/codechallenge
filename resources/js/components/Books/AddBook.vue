<template>
  <div>
    <el-form v-if="isadmin" :model="book" ref="book" label-width="120px">
      <el-form-item label="Title" for="ftitle">
        <el-input id="ftitle" v-model="$v.book.title.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.book.title.$model"
          >A title is required</span>
        </p>
      </el-form-item>

      <el-form-item label="Author" for="fa">
        <el-input id="fa" v-model="$v.book.author.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.book.author.$model"
          >An author is required</span>
        </p>
      </el-form-item>

      <el-form-item label="Status" for="fstatus">
        <el-radio-group id="fstatus" v-model="$v.book.status.$model">
          <el-radio label="1">Available</el-radio>
          <el-radio label="0">Borrowed</el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="Category" for="fcategory">
        <el-select id="fcategory" v-model="$v.book.category_id.$model" placeholder="Category">
          <el-option
            v-for="category in orderedCategories"
            :value="category.id"
            :key="category.id"
            :label="category.name"
          >{{ category.name }}</el-option>
        </el-select>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.book.category_id.$model"
          >A category is required</span>
        </p>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click.prevent="addBook()">Create</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";
export default {
  props: ["choices"],
  computed: {
    orderedUsers() {
      return _.orderBy(this.choices.users, "first_name");
    },
    orderedCategories() {
      return _.orderBy(this.choices.categories, "name");
    }
  },
  data() {
    return {
      uiState: "submit not clicked",
      errors: false,
      empty: true,
      formTouched: false,
      book: {
        title: "",
        author: "",
        status: "1",
        reservor_id: "",
        category_id: ""
      },
      isadmin: false
    };
  },
  validations: {
    book: {
      title: { required },
      author: { required },
      status: { required },
      category_id: { required },
    }
  },
  methods: {
    addBook() {
      this.formTouched = !this.$v.book.$anyDirty;
      this.errors = this.$v.book.$anyError;
      this.uiState = "submit clicked";
      if (this.errors === false && this.formTouched === false) {
        axios.post("/api/books/", this.book).then(response => {
          this.$router.push("/books");
          this.$notify({
            title: "Success",
            message: "The new book has been added.",
            type: "success",
            duration: 10000
          });
          this.uiState = "form submitted";
        });
      } else {
        return false;
      }
    },
    cancel() {
      this.$router.push("/books");
      this.$notify({
        title: "Info",
        message: "Changes, if any, have been discarded",
        type: "info",
        duration: 10000
      });
    },
    getAdmin() {
      axios.get("/api/users/isadmin").then(response => {
        this.isadmin = response.data;
      });
    }
  },
  created() {
    this.getAdmin();
  }
};
</script>

<style>
.same-line {
  display: inline-block;
}
</style>