<template>
  <div>
    <el-button @click="download">Download Weekly Report</el-button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      report: {}
    };
  },
  methods: {
    download() {
      axios.get("/api/weeklyreport/exportpdf", this.report).then(response => {});
    }
  }
};
</script>
