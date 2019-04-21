<template>
  <div>

    <p class="report-text">Click on the button below to get a summary of the number of users who were suspended, books that were borrowed, and books that have been returned in the last 7 days.</p>
    <a href="/weeklyreport">
      <el-button @click="download">Download Weekly Report</el-button>
    </a>
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

<style>
  .report-text {
    color: white;
    font-size: 14px; 
  }
</style>