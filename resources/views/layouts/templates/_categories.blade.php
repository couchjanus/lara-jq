<template id="addCategory">
<form method="POST" action="">
  @csrf
  <div class="form-group">
    <label for="name">Category name</label>
    <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp">
    <small id="nameHelp" class="form-text text-muted">Enter categoy name.</small>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</template>