  
<template>
  <div class="card shadow h-100 py-2" :class="'border-left-'+bg">
    <div class="card-body">
      <div class="row no-gutters align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-uppercase mb-1" :class="'text-'+bg">{{title}}</div>
          <div class="h5 mb-0 font-weight-bold text-gray-800">
            <slot></slot>
            {{number}}
          </div>
        </div>
        <div class="col-auto">
          <i class="fa-2x text-gray-300" :class="icon"></i>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["bg", "title", "number", "icon"],
};
</script>