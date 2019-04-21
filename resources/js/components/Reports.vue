<template>
  <div>
    <el-button @click="download">Download Weekly Report</el-button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      report: []
    };
  },
  methods: {
    download() {
      axios.get("/weeklyreport").then(response => {
        this.report = response.data;
      });
    }
  }
};
</script>
