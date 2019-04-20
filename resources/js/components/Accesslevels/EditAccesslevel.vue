<template>
  <div>
    <el-form
      :model="editedAccesslevel"
      :rules="rules"
      ref="accesslevel"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Access Level" prop="name">
        <el-input v-model="editedAccesslevel.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="editAccesslevel('accesslevel', editedAccesslevel)">Edit</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  props: ["accesslevel"],

  data() {
    return {
      editedAccesslevel: this.accesslevel,
      rules: {
        name: [
          {
            required: true,
            message: "Please type in the access level name",
            trigger: "blur"
          }
        ]
      }
    };
  },
  methods: {
    editAccesslevel(formName, editedAccesslevel) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios
            .put("/api/accesslevels/" + editedAccesslevel.id, editedAccesslevel)
            .then(response => {
              this.$router.push("/accesslevels");
              this.$notify({
                title: "Success",
                message: "The access level name has been edited.",
                type: "success"
              });
              this.editedAccesslevel = {};
            });
        } else {
          return false;
        }
      });
    },
    cancel() {
      this.$router.push("/accesslevels");
      this.$notify({
        title: "Info",
        message: "Changes, if any, have been discarded",
        type: "info"
      });
    }
  }
};
</script>