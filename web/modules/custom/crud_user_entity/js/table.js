(function ($) {
  // convert from unix date to human-readable date
  $(() => {
    // applies formatting to selectors defined in the array
    $.each(['.created', '.changed'], (i, val) => {
      const dateElement = $(val),
        dateUnix = parseInt(dateElement.text()),
        dateForHumans = new Date(dateUnix * 1000),
        dateString = `${dateForHumans.getDay()}/${dateForHumans.getMonth()}/${dateForHumans.getFullYear()} ${dateForHumans.getHours()}:${dateForHumans.getMinutes()}`;
      // set formatted date
      dateElement.text(dateString);
    });
  });
})(jQuery);
