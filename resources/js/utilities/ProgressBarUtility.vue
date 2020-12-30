  
<template>
  <div>
    <h4 class="small font-weight-bold">
      {{title}} : {{number}}
      <span class="float-right">{{Math.round((number/total)*100)}}%</span>
    </h4>
    <div class="progress mb-4">
      <div
        class="progress-bar"
        :class="'bg-'+bg"
        role="progressbar"
        :style="'width:'+ (number/total)*100 +'%'"
        :aria-valuenow="(number/total)*100"
        aria-valuemin="0"
        aria-valuemax="100"
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["title", "number", "total", "bg"],
};
</script>