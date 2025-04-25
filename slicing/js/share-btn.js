$(document).ready(function () {
  const $document = $(document);

  $document.on("click", ".share-btn", function () {
    const $this = $(this);
    const $overlay = $this.siblings(".share-overlay");
    $overlay.addClass("active");
    $this.hide();
  });

  $document.on("click", ".share-overlay #close", function () {
    const $this = $(this);
    const $overlay = $this.closest(".share-overlay");
    const $shareBtn = $overlay.siblings(".share-btn");
    $overlay.removeClass("active");
    $shareBtn.show();
  });
});
