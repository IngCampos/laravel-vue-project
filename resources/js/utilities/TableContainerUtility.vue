<template>
  <div class="table-container">
      <table style="width:100%" class="table table-striped table-bordered">
        <thead>
          <tr>
            <slot name="head"/>
          </tr>
        </thead>
        <slot name="tbody"/>
        <tbody>
            <slot name="body"/>
        </tbody>
      </table>
      <div class="text-center">
        <slot name="footer"/>
      </div>
  </div>
</template>

// TODO: Fix little bug in body and tbody
// Elements that has many tbody use tbody who uses just one use body
