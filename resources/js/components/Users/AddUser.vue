<template>
  <div>
    <el-form :model="book" :rules="rules" ref="book" label-width="120px" class="demo-ruleForm">
      <el-form-item label="Book Title" prop="title">
        <el-input v-model="book.title"></el-input>
      </el-form-item>

      <el-form-item label="Status" prop="status">
        <el-radio-group v-model="book.status">
          <el-radio label="Available"></el-radio>
          <el-radio label="Borrowed"></el-radio>
        </el-radio-group>
      </el-form-item>

      <el-form-item label="Reserved By">
        <el-select v-model="book.reservor_id" placeholder="Reserved By">
          <el-option
            v-for="user in orderedUsers"
            :value="user.id"
            :key="user.id"
          >{{ user.full_name }}</el-option>
        </el-select>
      </el-form-item>

      <el-form-item label="Category" prop="category">
        <el-select v-model="book.category_id" placeholder="Category">
          <el-option
            v-for="category in orderedCategories"
            :value="category.id"
            :key="category.id"
            :label="category.name"
          >{{ category.name }}</el-option>
        </el-select>
      </el-form-item>

      <el-form-item>
        <el-button type="primary" @click="addBook('book')">Create</el-button>
        <el-button @click="resetForm('book')">Reset</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
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
      book: {
        title: "",
        status: "",
        reservor_id: "",
        category_id: ""
      },
      rules: {
        title: [
          {
            required: true,
            message: "Please input the book's title",
            trigger: "blur"
          }
        ],
        status: [
          {
            required: true,
            message: "Please select the book's status",
            trigger: "change"
          }
        ],
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
    addBook(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios.post("/api/books/", this.book).then(response => {});
          this.$router.push("/books");
          this.$notify({
            title: "Success",
            message: "The new book has been added.",
            type: "success"
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