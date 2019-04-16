<template>
  <div>
    <!-- <el-form :model="book" label-width="120px">
      <el-form-item label="Book Title">
        <el-input v-model="book.title"></el-input>
      </el-form-item>

      <el-form-item label="Status">
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

      <el-form-item label="Category">
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
        <el-button type="primary" @click="editBook(book)">Edit</el-button>
        <el-button @click="resetForm('book')">Reset</el-button>
      </el-form-item>
    </el-form> -->
    
  </div>
</template>

<script>
export default {
  props: ["choices", "book"],
  computed: {
    orderedUsers() {
      return _.orderBy(this.choices.users, "first_name");
    },
    orderedCategories() {
      return _.orderBy(this.choices.categories, "name");
    }
  },
  data() {
    return {};
  },
  methods: {
    editBook(book) {
      axios.put("/api/books/" + book.id, book).then(response => {});
      this.$router.push("/books");
      this.$notify({
        title: "Success",
        message: "The new book has been added.",
        type: "success"
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  },
  mounted() {
    console.log(this.book);
    // console.log(this.choices);
  }
};
</script>