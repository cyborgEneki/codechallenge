<template>
  <div>
    <el-form :model="editedBook" ref="book" label-width="120px">
      <el-form-item label="Book" for="ftitle">
        <el-input id="ftitle" v-model="$v.editedBook.title.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedBook.title.$model"
          >A title is required</span>
        </p>
        <p></p>
      </el-form-item>
      
      <el-form-item label="Author" for="fa">
        <el-input id="fa" v-model="$v.editedBook.author.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedBook.author.$model"
          >An author is required</span>
        </p>
        <p></p>
      </el-form-item>

      <el-form-item label="Category" for="fcategory">
        <el-select
          id="fcategory"
          v-model="$v.editedBook.category_id.$model"
          placeholder="Category"
        >
          <el-option
            v-for="category in orderedCategories"
            :value="category.id"
            :key="category.id"
            :label="category.name"
          >{{ category.name }}</el-option>
        </el-select>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedBook.category_id.$model"
          >A category is required</span>
        </p>
        <p></p>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="editBook(editedBook.id)">Edit</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
import { required } from "vuelidate/lib/validators";

export default {
  props: ["book", "choices"],
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
      editedBook: this.book,
    };
  },
  validations: {
    editedBook: {
      title: { required },
      author: { required },
      category_id: { required },
    }
  },
  methods: {
    editBook(id) {
      this.formTouched = !this.$v.editedBook.$anyDirty;
      this.errors = this.$v.editedBook.$anyError;
      this.uiState = "submit clicked";
      if (this.errors === false && this.formTouched === false) {
        axios.put("/api/books/" + id, this.editedBook).then(response => {
          this.$router.push("/books");
          this.$notify({
            title: "Success",
            message: "The book details have been edited.",
            type: "success",
            duration: 10000
          });
          this.editedBook = {};
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
    }
  }
};
</script>