<template>
  <div>
    <el-form
      :model="editedDepartment"
      :rules="rules"
      ref="department"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Department" prop="name">
        <el-input v-model="editedDepartment.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="editDepartment('department', editedDepartment)">Edit</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  props: ["department"],

  data() {
    return {
      editedDepartment: this.department,
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
    editDepartment(formName, editedDepartment) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios
            .put("/api/departments/" + editedDepartment.id, editedDepartment)
            .then(response => {
              this.$router.push("/departments");
              this.$notify({
                title: "Success",
                message: "The department name has been edited.",
                type: "success",
                duration: 10000
              });
              this.editedDepartment = {};
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