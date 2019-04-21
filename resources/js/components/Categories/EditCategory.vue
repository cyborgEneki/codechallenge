<template>
  <div>
    <el-form
      :model="editedCategory"
      :rules="rules"
      ref="category"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Category" prop="name">
        <el-input v-model="editedCategory.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="editCategory('category', editedCategory)">Edit</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  props: ["category"],

  data() {
    return {
      editedCategory: this.category,
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
    editCategory(formName, editedCategory) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios
            .put("/api/categories/" + editedCategory.id, editedCategory)
            .then(response => {
              this.$router.push("/categories");
              this.$notify({
                title: "Success",
                message: "The category name has been edited.",
                type: "success",
                duration: 10000
              });
              this.editedCategory = {};
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
        type: "info",
        duration: 10000
      });
    }
  }
};
</script>