import $ from 'jquery';
import whatInput from 'what-input';

window.$ = $;

import Foundation from 'foundation-sites';
// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';

// I would like to be able to pull this from wordpress with php later on
// I will have to use a seperate php script to get working
// This, for example, will work:

// script.php

// $num = $_POST["num"];
// echo $num * 2;
// Javascript(jQuery) (on another page):

// $.post('script.php', { num: 5 }, function(result) { 
//    alert(result); 
// });

var tracklist =  [
    {
        src: "http://katbohnbusiness.developer/wp-content/uploads/2019/02/01-Kat-Bohn-Commercial-Demo.mp3",
        title: "Demo Reel",
    },
    {
        src: "http://katbohnbusiness.developer/wp-content/uploads/2019/02/Kat-Bohn-singing-samples.mp3",
        title: "Singing Samples",
    },
    {
        src: "http://katbohnbusiness.developer/wp-content/uploads/2019/02/KATHERINE-BOHN-NARRATION-DEMO-MASTER.mp3",
        title: "Narration Demo",
    },
];

var player = false;
var track = 1;
var lastTrack = -1;

// play music function
var play = function() {
    // Load in new song to player if not equal to last track
    if (lastTrack != track) {
        player.src = tracklist[track - 1].src;
        $(".track-title").text(tracklist[track-1].title);
    }

    // store what the current track is
    lastTrack = track;

    // play song
    if (player.paused) {
        player.play();
    }
};

$(document).foundation();

$(document).ready(function() {
    // audio player logic
    // stop default actions of link just in case
    $('.audioButtons > a').click(function(event) {
        event.preventDefault();
    });
    // play on click
    $(".play").click(function() {
        // this is because an action is needed before playing
        audioCtx.resume();
        // launches the play function that handles launching the music and cycling
        play();
        // toggle the play button visiblity
        $(".audioButtons > a.primary").toggleClass("active");
        // remove the pulse animation that happens on load
        $(".play").removeClass("pulse");
    });

    // pause on click
    $(".pause").click(function() {
        // checks to make sure it is not already paused.
        if (!player.paused) {
            player.pause();
        };
        // Toggles the visibility
        $(".audioButtons > a.primary").toggleClass("active");
    });

    // skip to next track
    $('.next').click(function() {
        // itterate thru track counter
        track++;
        // If it is past the array lenght of tracks the circle back
        if (track > tracklist.length) {
            track = 1;
        }
        // play when next track selected
        play();
    });

    // same functionality as the next just backwards
    $('.previous').click(function() {
        track--;
        if (track < 1) {
            track = tracklist.length;
        }
        play();
    });
    
    var audioCtx = new(window.AudioContext || window.webkitAudioContext)();
    player = document.getElementById('audioElement');
    // player = document.createElement('audio');
    var audioSrc = audioCtx.createMediaElementSource(audioElement);
    var analyser = audioCtx.createAnalyser();

    // Bind our analyser to the media element source.
    audioSrc.connect(analyser);
    audioSrc.connect(audioCtx.destination);

    //var frequencyData = new Uint8Array(analyser.frequencyBinCount);
    if($(window).width() > 500) {
        var bars = 30;
    } else {
        var bars = 15;
    }
    var frequencyData = new Uint8Array(bars);
    console.log(frequencyData);

    var svgHeight = $(".visualizer").height().toString();
    var svgWidth = $(".visualizer").width().toString();
    var barPadding = '0';

    console.log("height " + svgHeight + " and width " + svgWidth);

    function createSvg(parent, height, width) {
        return d3.select(parent).append('svg').attr('height', height).attr('width', width);
    }

    var svg = createSvg('.visualizer', svgHeight, svgWidth);

    // Create our initial D3 chart.
    svg.selectAll('rect')
        .data(frequencyData)
        .enter()
        .append('rect')
        .attr('x', function (d, i) {
            return i * (svgWidth / frequencyData.length);
        })
        .attr('width', svgWidth / frequencyData.length - barPadding);

    // Continuously loop and update chart with frequency data.
    function renderChart() {
        requestAnimationFrame(renderChart);

        // Copy frequency data to frequencyData array.
        analyser.getByteFrequencyData(frequencyData);

        // Update d3 chart with new data.
        svg.selectAll('rect')
            .data(frequencyData)
            .each(function(d) {
                return d;
            })
            .attr('y', function(d) {
                return svgHeight - d;
            })
            .attr('height', function(d) {
                return d;
            })
            .attr('fill', function(d) {
                return 'rgb(255,255,255)';
            });
    }

    // Run the loop
    renderChart();
});