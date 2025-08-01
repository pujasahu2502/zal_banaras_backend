var option_PDFF = {
 
	/* BASIC SETTINGS */  
 	openPage: 1,
    height: '100%',
    enableSound: true,
    downloadEnable: true, 
    direction: pdfflip.DIRECTION.LTR,
    autoPlay: true,
    autoPlayStart: false,
    autoPlayDuration: 5000,
    autoEnableOutline: false,
    autoEnableThumbnail: false,


	/* TRANSLATE INTERFACE */  
 
    text: {
      toggleSound: "Sound",
      toggleThumbnails: "Thumbnails",
      toggleOutline: "Contents",
      previousPage: "Previous Page",
      nextPage: "Next Page",
      toggleFullscreen: "Fullscreen",
      zoomIn: "Zoom In",
      zoomOut: "Zoom Out",
      downloadPDFFile: "Download PDF",
      gotoFirstPage: "First Page",
      gotoLastPage: "Last Page",
      play: "AutoPlay On",
      pause: "AutoPlay Off",
      share: "Share"
    },




	/* ADVANCED SETTINGS */  

    hard: "none",
    overwritePDFOutline: true,
    duration: 2000,
    pageMode: pdfflip.PAGE_MODE.AUTO,
    singlePageMode: pdfflip.SINGLE_PAGE_MODE.AUTO,
	transparent: false,
	scrollWheel: true,
    zoomRatio: 1.4,
	maxTextureSize: 1600,
	backgroundImage: "pflip/background.jpg",
    backgroundColor: "#fff",
    controlsPosition: pdfflip.CONTROLSPOSITION.BOTTOM,
    allControls: "outline,thumbnail,play,altPrev,pageNumber,altNext,zoomIn,zoomOut,fullScreen,download,sound,share",
    hideControls: "startPage,endPage",

};

var pdfflipLocation = "./pflip/";
