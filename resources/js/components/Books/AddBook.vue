<template>
  <div>
    <el-form v-if="isadmin" :model="book" ref="book" label-width="120px">
      <el-form-item label="Book" for="ftitle">
        <el-input id="ftitle" v-model.lazy="$v.book.title.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.book.title.$model"
          >"The book without a title" makes for a good title...but still type in a title to continue</span>
        </p>
      </el-form-item>

      <el-form-item label="Status" for="fstatus">
        <el-radio-group id="fstatus" v-model.lazy="$v.book.status.$model">
          <el-radio label="Available"></el-radio>
          <el-radio label="Borrowed"></el-radio>
        </el-radio-group>
        <p v-if="errors" class="error">
          <span v-if="!$v.book.status.$model">A status is required</span>
        </p>
      </el-form-item>

      <el-form-item label="Reserved By" for="freservor">
        <el-select
          id="freservor"
          v-model.lazy="$v.book.reservor_id.$model"
          placeholder="Reserved By"
        >
          <el-option
            v-for="user in orderedUsers"
            :value="user.id"
            :key="user.id"
          >{{ user.full_name }}</el-option>
        </el-select>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.book.reservor_id.$model"
          >A user without a department is like a game without thrones!</span>
        </p>
      </el-form-item>

      <el-form-item label="Category" for="fcategory">
        <el-select id="fcategory" v-model.lazy="$v.book.category_id.$model" placeholder="Category">
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
          >This cannot be blank. Users will never find what they like</span>
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
        status: "",
        reservor_id: "",
        category_id: ""
      },
      isadmin: false
    };
  },
  validations: {
    book: {
      title: { required },
      status: { required },
      reservor_id: { required },
      category_id: { required }
    }
  },
  methods: {
    addBook() {
      this.formTouched = !this.$v.book.$anyDirty;
      this.errors = this.$v.book.$anyError;
      this.uiState = "submit clicked";
      if (this.errors === false && this.formTouched === false) {
        axios.post("/api/books/", this.book).then(response => {});
        this.book = {};
        this.$router.push("/books");
        this.$notify({
          title: "Success",
          message: "The new book has been added.",
          type: "success"
        });
        this.uiState = "form submitted";
      } else {
        return false;
      }
    },
    cancel() {
      this.$router.push("/books");
      this.$notify({
        title: "Info",
        message: "Changes, if any, have been discarded",
        type: "info"
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