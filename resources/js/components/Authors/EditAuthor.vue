<template>
  <div>
    <el-form :model="editedAuthor" :rules="rules" ref="author" label-width="120px" class="demo-ruleForm">
      <el-form-item label="Author" prop="name">
        <el-input v-model="editedAuthor.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="editAuthor('author', editedAuthor)">Edit</el-button>
        <el-button @click="resetForm('author')">Reset</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  props: ["author"],

  data() {
    return {
      editedAuthor: this.author,
      rules: {
        name: [
          {
            required: true,
            message: "Please type in the author name",
            trigger: "blur"
          }
        ]
      }
    };
  },
  methods: {
    editAuthor(formName, editedAuthor) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios.put("/api/authors/" + editedAuthor.id, editedAuthor).then(response => {
            this.$router.push("/authors");
            this.$notify({
              title: "Success",
              message: "The author name has been edited.",
              type: "success"
            });
            this.editedAuthor = {};
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