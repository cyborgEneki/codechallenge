<template>
  <div>
    <el-form
      :model="department"
      :rules="rules"
      ref="department"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Department" prop="name">
        <el-input v-model="department.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addDepartment('department')">Create</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      department: {
        name: ""
      },
      rules: {
        name: [
          {
            required: true,
            message: "A department name is required",
            trigger: "blur"
          }
        ]
      }
    };
  },
  methods: {
    addDepartment(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios.post("/api/departments/", this.department).then(response => {
            this.$router.push("/departments");
            this.$notify({
              title: "Success",
              message: "The new department has been added.",
              type: "success",
              duration: 10000
            });
          });
        } else {
          return false;
        }
      });
    },
    cancel() {
      this.$router.push("/departments");
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