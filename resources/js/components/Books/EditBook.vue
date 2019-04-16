<template>
  <div>
    <el-form
      :model="editedBook"
      :rules="rules"
      ref="book"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Book" prop="title">
        <el-input v-model="editedBook.title"></el-input>
      </el-form-item>

      <el-form-item label="Status" prop="status">
        <el-radio-group v-model="editedBook.status">
          <el-radio label="Available"></el-radio>
          <el-radio label="Borrowed"></el-radio>
        </el-radio-group>
      </el-form-item>

      <!-- <el-form-item label="Reserved By"> -->
        <!-- <el-select v-model="editedBook.reservor_id" placeholder="Reserved By">
          <el-option
            v-for="user in orderedUsers"
            :value="user.id"
            :key="user.id"
          >{{ user.full_name }}</el-option>
        </el-select>
      </el-form-item> -->

      <el-form-item label="Category" prop="category">
        <el-select v-model="editedBook.category_id" placeholder="Category">
          <el-option
            v-for="category in orderedCategories"
            :value="category.id"
            :key="category.id"
            :label="category.name"
          >{{ category.name }}</el-option>
        </el-select>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="editBook('book', editedBook)">Edit</el-button>
        <el-button @click="resetForm('book')">Reset</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  props: ["book","choices"],
  computed: {
    // orderedUsers() {
    //   return _.orderBy(this.choices.users, "first_name");
    // },
    orderedCategories() {
      return _.orderBy(this.choices.categories, "name");
    }
  },
  data() {
    return {
      editedBook: this.book,
      rules: {
        title: [
          {
            required: true,
            message: "Please type in the new book title",
            trigger: "blur"
          }
        ],
        status: [
          {
            required: true,
            message: "Please select the book's status",
            trigger: "change"
          }
        ]
        // category: [
        //   {
        //     required: true,
        //     message: "Please select the book's category",
        //     trigger: "change"
        //   }
        // ]
      }
    };
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
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  }
};
</script>