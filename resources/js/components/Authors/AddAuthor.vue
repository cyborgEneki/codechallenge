<template>
  <div>
    <el-form :model="author" :rules="rules" ref="author" label-width="120px" class="demo-ruleForm">
      <el-form-item label="Author" prop="name">
        <el-input v-model="author.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addAuthor('author')">Create</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      author: {
        name: ""
      },
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
    addAuthor(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios.post("/api/authors/", this.author).then(response => {});
          this.$router.push("/authors");
          this.$notify({
            title: "Success",
            message: "The new author has been added.",
            type: "success"
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
        message: "Changes, if any, have been discarded",
        type: "info"
      });
    }
  }
};
</script>