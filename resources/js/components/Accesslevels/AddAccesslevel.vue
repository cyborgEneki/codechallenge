<template>
  <div>
    <el-form
      :model="accesslevel"
      :rules="rules"
      ref="accesslevel"
      label-width="120px"
      class="demo-ruleForm"
    >
      <el-form-item label="Access Level" prop="name">
        <el-input v-model="accesslevel.name"></el-input>
      </el-form-item>
      <el-form-item>
        <el-button type="primary" @click="addAccesslevel('accesslevel')">Create</el-button>
        <el-button @click="cancel">Cancel</el-button>
      </el-form-item>
    </el-form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      accesslevel: {
        name: ""
      },
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
    addAccesslevel(formName) {
      this.$refs[formName].validate(valid => {
        if (valid) {
          axios.post("/api/accesslevels/", this.accesslevel).then(response => {});
          this.$router.push("/accesslevels");
          this.$notify({
            title: "Success",
            message: "The new access level has been added.",
            type: "success"
          });
          this.accesslevel = {};
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