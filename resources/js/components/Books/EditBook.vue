<template>
  <div>
    <el-form :model="editedBook" ref="book" label-width="120px">
      <el-form-item label="Book" for="ftitle">
        <el-input id="ftitle" v-model.lazy="$v.editedBook.title.$model"></el-input>
        <p v-if="errors" class="error">
          <span
            v-if="!$v.editedBook.title.$model"
          >"The book without a title" makes for a good title...but still type in a title to continue</span>
        </p>
        <p></p>
      </el-form-item>

      <el-form-item label="Author" for="fauthor">
        <el-select id="fauthor" v-model="$v.editedBook.author_id.$model" placeholder="Author(s)">
          <el-option
            v-for="author in orderedAuthors"
            :value="author.id"
            :key="author.id"
            :label="author.name"
          >{{ author.name }}</el-option>
        </el-select>
        <el-button
          class="same-line"
          type="success"
          icon="el-icon-check"
          circle
          @click.prevent="addAuthor(editedBook.id, editedBook.author_id)"
        >Save</el-button>
        <a href="#" class="same-line" @click.prevent="dataItem=''">Cancel</a>
      </el-form-item>

      <el-form-item label="Status" for="fstatus">
        <el-radio-group id="fstatus" v-model.lazy="$v.editedBook.status.$model">
          <el-radio label="Available"></el-radio>
          <el-radio label="Borrowed"></el-radio>
        </el-radio-group>
        <p v-if="errors" class="error">
          <span v-if="!$v.editedBook.status.$model">A status is required</span>
        </p>
      </el-form-item>

      <el-form-item label="Category" for="fcategory">
        <el-select
          id="fcategory"
          v-model.lazy="$v.editedBook.category_id.$model"
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
          >This cannot be blank. Users will never find what they like</span>
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
    },
    orderedAuthors() {
      return _.orderBy(this.choices.authors, "name");
    }
  },
  data() {
    return {
      uiState: "submit not clicked",
      errors: false,
      empty: true,
      formTouched: false,
      editedBook: this.book,
      authors: []
    };
  },
  validations: {
    editedBook: {
      title: { required },
      status: { required },
      category_id: { required },
      author_id: { required }
    }
  },
  methods: {
    addAuthor(bookId, authorId) {
      this.editedBook.id == bookId;
      this.book.author_id == authorId;
      console.log(bookId);
      console.log(authorId);
      axios.post("/api/books/"+bookId+"/authors/"+authorId, this.book).then(response => {
        // this.book.authors.push(this.choices.authors[authorId]);
        // this.book = "";
      });
    },
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
            type: "success"
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
        type: "info"
      });
    }
  }
};
</script>