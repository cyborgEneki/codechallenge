<template>
  <div>
    <el-form
      :model="category"
      :rules="rules"
      ref="category"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Category" prop="name">
        <el-input v-model="category.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addCategory('category')">Create</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      category: {
        name: ""
      },
      rules: {
        name: [
          {
            required: true,
            message: "A category name is required",
            trigger: "blur"
          }
        ]
      }
    };
  },
  methods: {
    addCategory(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios.post("/api/categories/", this.category).then(response => {
            this.$router.push("/categories");
            this.$notify({
              title: "Success",
              message: "The new category has been added.",
              type: "success"
            });
          });
        } else {
          return false;
        }
      });
    },

    cancel() {
      this.$router.push("/categories");
      this.$notify({
        title: "Info",
        message: "Changes, if any, have been discarded",
        type: "info"
      });
    }
  }
};
</script>