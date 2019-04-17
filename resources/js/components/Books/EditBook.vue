<template>
  <div>
    <el-form :model="editedBook" ref="book" label-width="120px">
      <el-form-item label="Book" for="ftitle">
        <el-input id="ftitle" v-model.lazy="$v.editedBook.title.$model"></el-input>
        <p
          class="error"
          v-if="!$v.editedBook.title.$model"
        >"The book without a title" makes for a good title...but still type in a title to continue</p>
      </el-form-item>

      <el-form-item label="Status" for="fstatus">
        <el-radio-group id="fstatus" v-model.lazy="$v.editedBook.status.$model">
          <el-radio label="Available"></el-radio>
          <el-radio label="Borrowed"></el-radio>
        </el-radio-group>
        <p class="error" v-if="!$v.editedBook.status.$model">A status is required</p>
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
        <p
          class="error"
          v-if="!$v.editedBook.category_id.$model"
        >This cannot be blank. Users will never find what they like</p>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="editBook('book', editedBook)">Edit</el-button>
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
      editedBook: this.book
    };
  },
  validations: {
    editedBook: {
      title: { required },
      status: { required },
      category_id: { required }
    }
  },
  methods: {
    editBook(formName, editedBook) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios
            .put("/api/books/" + editedBook.id, editedBook)
            .then(response => {
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
      });
    },
    cancel() {
      this.$router.push("/users");
      this.$notify({
        title: "Info",
        message: "Your changes have been discarded",
        type: "success"
      });
    }
  }
};
</script>