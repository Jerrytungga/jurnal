<?php
include '../database.php';
// sistem ganti password siswa
if (isset($_POST['edit_profile'])) {
  $nis = htmlspecialchars($_POST['nis']);
  $password = htmlspecialchars($_POST['password']);
  $addtotable = mysqli_query($conn, "UPDATE `siswa` SET `password`='$password' WHERE `siswa`.`nis` = '$nis'");
  header('location:profile.php');
}
// cek apakah yang mengakses halaman ini sudah login
session_start();
include 'template/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>My Profile</title>
  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<div class='snow-flakes'>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
  <div class='flake'></div>
</div>

<script type='text/javascript'>
  //<![CDATA[
  var snowStorm = null;

  function SnowStorm() {
    this.flakesMax = 200, this.flakesMaxActive = 100, this.animationInterval = 33, this.flakeBottom = null, this.targetElement = null, this.followMouse = true, this.snowColor = "#344CB7", this.snowCharacter = "&bull;", this.snowStick = !0, this.useMeltEffect = !0, this.useTwinkleEffect = !1, this.usePositionFixed = !1, this.flakeLeftOffset = 0, this.flakeRightOffset = 0, this.flakeWidth = 8, this.flakeHeight = 8, this.vMaxX = 5, this.vMaxY = 10, this.zIndex = 0;
    var e = void 0 === window.attachEvent ? function(e, t, i) {
        return e.addEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.attachEvent("on" + t, i)
      },
      t = void 0 === window.attachEvent ? function(e, t, i) {
        return e.removeEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.detachEvent("on" + t, i)
      };

    function i(e, t) {
      return isNaN(t) && (t = 0), Math.random() * e + t
    }
    var n = this,
      o = this;
    this.timers = [], this.flakes = [], this.disabled = !1, this.active = !1;
    var s = navigator.userAgent.match(/msie/i),
      l = navigator.userAgent.match(/msie 6/i),
      a = s && (l || navigator.userAgent.match(/msie 5/i)),
      r = navigator.appVersion.match(/windows 98/i),
      f = navigator.userAgent.match(/iphone/i),
      m = !!(s && "BackCompat" == document.compatMode || l || f),
      h = null,
      c = null,
      d = null,
      u = null,
      v = null,
      k = null,
      g = 1,
      w = !1,
      y = function() {
        try {
          document.createElement("div").style.opacity = "1.7"
        } catch (e) {
          return !1
        }
        return !0
      }(),
      p = document.createDocumentFragment();
    null === n.flakeLeftOffset && (n.flakeLeftOffset = 0), null === n.flakeRightOffset && (n.flakeRightOffset = 0), this.meltFrameCount = 20, this.meltFrames = [];
    for (var x = 0; x < this.meltFrameCount; x++) this.meltFrames.push(1 - x / this.meltFrameCount);
    this.randomizeWind = function() {
      var e;
      if (e = i(n.vMaxX, .2), v = 1 == parseInt(i(2), 10) ? -1 * e : e, k = i(n.vMaxY, .2), this.flakes)
        for (var t = 0; t < this.flakes.length; t++) this.flakes[t].active && this.flakes[t].setVelocities()
    }, this.scrollHandler = function() {
      if (u = n.flakeBottom ? 0 : parseInt(window.scrollY || document.documentElement.scrollTop || document.body.scrollTop, 10), isNaN(u) && (u = 0), !w && !n.flakeBottom && n.flakes)
        for (var e = n.flakes.length; e--;) 0 === n.flakes[e].active && n.flakes[e].stick()
    }, this.resizeHandler = function() {
      window.innerWidth || window.innerHeight ? (h = window.innerWidth - (s ? 2 : 16) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : window.innerHeight) : (h = (document.documentElement.clientWidth || document.body.clientWidth || document.body.scrollWidth) - (s ? 0 : 8) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : document.documentElement.clientHeight || document.body.clientHeight || document.body.scrollHeight), c = parseInt(h / 2, 10)
    }, this.resizeHandlerAlt = function() {
      h = n.targetElement.offsetLeft + n.targetElement.offsetWidth - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : n.targetElement.offsetTop + n.targetElement.offsetHeight, c = parseInt(h / 2, 10)
    }, this.freeze = function() {
      if (n.disabled) return !1;
      n.disabled = 1;
      for (var e = n.timers.length; e--;) clearInterval(n.timers[e])
    }, this.resume = function() {
      if (!n.disabled) return !1;
      n.disabled = 0, n.timerInit()
    }, this.toggleSnow = function() {
      n.flakes.length ? (n.active = !n.active, n.active ? (n.show(), n.resume()) : (n.stop(), n.freeze())) : n.start()
    }, this.stop = function() {
      this.freeze();
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "none";
      t(window, "scroll", n.scrollHandler), t(window, "resize", n.resizeHandler), a || (t(window, "blur", n.freeze), t(window, "focus", n.resume))
    }, this.show = function() {
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "block"
    }, this.SnowFlake = function(e, t, n, o) {
      var s = this,
        l = e;
      this.type = t, this.x = n || parseInt(i(h - 20), 10), this.y = isNaN(o) ? -i(d) - 12 : o, this.vX = null, this.vY = null, this.vAmpTypes = [1, 1.2, 1.4, 1.6, 1.8], this.vAmp = this.vAmpTypes[this.type], this.melting = !1, this.meltFrameCount = l.meltFrameCount, this.meltFrames = l.meltFrames, this.meltFrame = 0, this.twinkleFrame = 0, this.active = 1, this.fontSize = 10 + this.type / 5 * 10, this.o = document.createElement("div"), this.o.innerHTML = l.snowCharacter, this.o.style.color = l.snowColor, this.o.style.position = w ? "fixed" : "absolute", this.o.style.width = l.flakeWidth + "px", this.o.style.height = l.flakeHeight + "px", this.o.style.fontFamily = "arial,verdana", this.o.style.overflow = "hidden", this.o.style.fontWeight = "normal", this.o.style.zIndex = l.zIndex, p.appendChild(this.o), this.refresh = function() {
        if (isNaN(s.x) || isNaN(s.y)) return !1;
        s.o.style.left = s.x + "px", s.o.style.top = s.y + "px"
      }, this.stick = function() {
        m || l.targetElement != document.documentElement && l.targetElement != document.body ? s.o.style.top = d + u - l.flakeHeight + "px" : l.flakeBottom ? s.o.style.top = l.flakeBottom + "px" : (s.o.style.display = "none", s.o.style.top = "auto", s.o.style.bottom = "0px", s.o.style.position = "fixed", s.o.style.display = "block")
      }, this.vCheck = function() {
        s.vX >= 0 && s.vX < .2 ? s.vX = .2 : s.vX < 0 && s.vX > -.2 && (s.vX = -.2), s.vY >= 0 && s.vY < .2 && (s.vY = .2)
      }, this.move = function() {
        var e = s.vX * g;
        s.x += e, s.y += s.vY * s.vAmp, s.x >= h || h - s.x < l.flakeWidth ? s.x = 0 : e < 0 && s.x - l.flakeLeftOffset < 0 - l.flakeWidth && (s.x = h - l.flakeWidth - 1), s.refresh(), d + u - s.y < l.flakeHeight ? (s.active = 0, l.snowStick ? s.stick() : s.recycle()) : (l.useMeltEffect && s.active && s.type < 3 && !s.melting && Math.random() > .998 && (s.melting = !0, s.melt()), l.useTwinkleEffect && (s.twinkleFrame ? (s.twinkleFrame--, s.o.style.visibility = s.twinkleFrame && s.twinkleFrame % 2 == 0 ? "hidden" : "visible") : Math.random() > .9 && (s.twinkleFrame = parseInt(20 * Math.random(), 10))))
      }, this.animate = function() {
        s.move()
      }, this.setVelocities = function() {
        s.vX = v + i(.12 * l.vMaxX, .1), s.vY = k + i(.12 * l.vMaxY, .1)
      }, this.setOpacity = function(e, t) {
        if (!y) return !1;
        e.style.opacity = t
      }, this.melt = function() {
        l.useMeltEffect && s.melting && s.meltFrame < s.meltFrameCount ? (s.meltFrame++, s.setOpacity(s.o, s.meltFrames[s.meltFrame]), s.o.style.fontSize = s.fontSize - s.fontSize * (s.meltFrame / s.meltFrameCount) + "px", s.o.style.lineHeight = l.flakeHeight + 2 + .75 * l.flakeHeight * (s.meltFrame / s.meltFrameCount) + "px") : s.recycle()
      }, this.recycle = function() {
        s.o.style.display = "none", s.o.style.position = w ? "fixed" : "absolute", s.o.style.bottom = "auto", s.setVelocities(), s.vCheck(), s.meltFrame = 0, s.melting = !1, s.setOpacity(s.o, 1), s.o.style.padding = "0px", s.o.style.margin = "0px", s.o.style.fontSize = s.fontSize + "px", s.o.style.lineHeight = l.flakeHeight + 2 + "px", s.o.style.textAlign = "center", s.o.style.verticalAlign = "baseline", s.x = parseInt(i(h - l.flakeWidth - 20), 10), s.y = parseInt(-1 * i(d), 10) - l.flakeHeight, s.refresh(), s.o.style.display = "block", s.active = 1
      }, this.recycle(), this.refresh()
    }, this.snow = function() {
      for (var e = 0, t = null, o = n.flakes.length; o--;) 1 == n.flakes[o].active ? (n.flakes[o].move(), e++) : 0 === n.flakes[o].active ? 0 : 0, n.flakes[o].melting && n.flakes[o].melt();
      e < n.flakesMaxActive && 0 === (t = n.flakes[parseInt(i(n.flakes.length), 10)]).active && (t.melting = !0)
    }, this.mouseMove = function(e) {
      if (!n.followMouse) return !0;
      var t = parseInt(e.clientX, 10);
      g = t < c ? t / c * 2 - 2 : (t -= c) / c * 2
    }, this.createSnow = function(e, t) {
      for (var s = 0; s < e; s++) n.flakes[n.flakes.length] = new n.SnowFlake(n, parseInt(i(6), 10)), (t || s > n.flakesMaxActive) && (n.flakes[n.flakes.length - 1].active = -1);
      o.targetElement.appendChild(p)
    }, this.timerInit = function() {
      n.timers = r ? [setInterval(n.snow, 3 * n.animationInterval), setInterval(n.snow, n.animationInterval)] : [setInterval(n.snow, n.animationInterval)]
    }, this.init = function() {
      n.randomizeWind(), n.createSnow(n.flakesMax), e(window, "resize", n.resizeHandler), e(window, "scroll", n.scrollHandler), a || (e(window, "blur", n.freeze), e(window, "focus", n.resume)), n.resizeHandler(), n.scrollHandler(), n.followMouse && e(document, "mousemove", n.mouseMove), n.animationInterval = Math.max(20, n.animationInterval), n.timerInit()
    };
    var E = !1;

    function F() {
      n.start(!0)
    }
    this.start = function(e) {
      if (E) {
        if (e) return !0
      } else E = !0;
      if ("string" == typeof n.targetElement) {
        var t = n.targetElement;
        if (n.targetElement = document.getElementById(t), !n.targetElement) throw new Error('Snowstorm: Unable to get targetElement "' + t + '"')
      }
      n.targetElement || (n.targetElement = s ? document.body : document.documentElement ? document.documentElement : document.body), n.targetElement != document.documentElement && n.targetElement != document.body && (n.resizeHandler = n.resizeHandlerAlt), n.resizeHandler(), n.usePositionFixed = n.usePositionFixed && !m, w = n.usePositionFixed, h && d && !n.disabled && (n.init(), n.active = !0)
    }, document.addEventListener ? (document.addEventListener("DOMContentLoaded", F, !1), window.addEventListener("load", F, !1)) : e(window, "load", F)
  }
  snowStorm = new SnowStorm;
  //]]>
</script>

<script type='text/javascript'>
  //<![CDATA[
  var snowStorm = null;

  function SnowStorm() {
    this.flakesMax = 200, this.flakesMaxActive = 100, this.animationInterval = 33, this.flakeBottom = null, this.targetElement = null, this.followMouse = true, this.snowColor = "#ECB365", this.snowCharacter = "&bull;", this.snowStick = !0, this.useMeltEffect = !0, this.useTwinkleEffect = !1, this.usePositionFixed = !1, this.flakeLeftOffset = 0, this.flakeRightOffset = 0, this.flakeWidth = 8, this.flakeHeight = 8, this.vMaxX = 5, this.vMaxY = 10, this.zIndex = 0;
    var e = void 0 === window.attachEvent ? function(e, t, i) {
        return e.addEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.attachEvent("on" + t, i)
      },
      t = void 0 === window.attachEvent ? function(e, t, i) {
        return e.removeEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.detachEvent("on" + t, i)
      };

    function i(e, t) {
      return isNaN(t) && (t = 0), Math.random() * e + t
    }
    var n = this,
      o = this;
    this.timers = [], this.flakes = [], this.disabled = !1, this.active = !1;
    var s = navigator.userAgent.match(/msie/i),
      l = navigator.userAgent.match(/msie 6/i),
      a = s && (l || navigator.userAgent.match(/msie 5/i)),
      r = navigator.appVersion.match(/windows 98/i),
      f = navigator.userAgent.match(/iphone/i),
      m = !!(s && "BackCompat" == document.compatMode || l || f),
      h = null,
      c = null,
      d = null,
      u = null,
      v = null,
      k = null,
      g = 1,
      w = !1,
      y = function() {
        try {
          document.createElement("div").style.opacity = "1.7"
        } catch (e) {
          return !1
        }
        return !0
      }(),
      p = document.createDocumentFragment();
    null === n.flakeLeftOffset && (n.flakeLeftOffset = 0), null === n.flakeRightOffset && (n.flakeRightOffset = 0), this.meltFrameCount = 20, this.meltFrames = [];
    for (var x = 0; x < this.meltFrameCount; x++) this.meltFrames.push(1 - x / this.meltFrameCount);
    this.randomizeWind = function() {
      var e;
      if (e = i(n.vMaxX, .2), v = 1 == parseInt(i(2), 10) ? -1 * e : e, k = i(n.vMaxY, .2), this.flakes)
        for (var t = 0; t < this.flakes.length; t++) this.flakes[t].active && this.flakes[t].setVelocities()
    }, this.scrollHandler = function() {
      if (u = n.flakeBottom ? 0 : parseInt(window.scrollY || document.documentElement.scrollTop || document.body.scrollTop, 10), isNaN(u) && (u = 0), !w && !n.flakeBottom && n.flakes)
        for (var e = n.flakes.length; e--;) 0 === n.flakes[e].active && n.flakes[e].stick()
    }, this.resizeHandler = function() {
      window.innerWidth || window.innerHeight ? (h = window.innerWidth - (s ? 2 : 16) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : window.innerHeight) : (h = (document.documentElement.clientWidth || document.body.clientWidth || document.body.scrollWidth) - (s ? 0 : 8) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : document.documentElement.clientHeight || document.body.clientHeight || document.body.scrollHeight), c = parseInt(h / 2, 10)
    }, this.resizeHandlerAlt = function() {
      h = n.targetElement.offsetLeft + n.targetElement.offsetWidth - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : n.targetElement.offsetTop + n.targetElement.offsetHeight, c = parseInt(h / 2, 10)
    }, this.freeze = function() {
      if (n.disabled) return !1;
      n.disabled = 1;
      for (var e = n.timers.length; e--;) clearInterval(n.timers[e])
    }, this.resume = function() {
      if (!n.disabled) return !1;
      n.disabled = 0, n.timerInit()
    }, this.toggleSnow = function() {
      n.flakes.length ? (n.active = !n.active, n.active ? (n.show(), n.resume()) : (n.stop(), n.freeze())) : n.start()
    }, this.stop = function() {
      this.freeze();
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "none";
      t(window, "scroll", n.scrollHandler), t(window, "resize", n.resizeHandler), a || (t(window, "blur", n.freeze), t(window, "focus", n.resume))
    }, this.show = function() {
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "block"
    }, this.SnowFlake = function(e, t, n, o) {
      var s = this,
        l = e;
      this.type = t, this.x = n || parseInt(i(h - 20), 10), this.y = isNaN(o) ? -i(d) - 12 : o, this.vX = null, this.vY = null, this.vAmpTypes = [1, 1.2, 1.4, 1.6, 1.8], this.vAmp = this.vAmpTypes[this.type], this.melting = !1, this.meltFrameCount = l.meltFrameCount, this.meltFrames = l.meltFrames, this.meltFrame = 0, this.twinkleFrame = 0, this.active = 1, this.fontSize = 10 + this.type / 5 * 10, this.o = document.createElement("div"), this.o.innerHTML = l.snowCharacter, this.o.style.color = l.snowColor, this.o.style.position = w ? "fixed" : "absolute", this.o.style.width = l.flakeWidth + "px", this.o.style.height = l.flakeHeight + "px", this.o.style.fontFamily = "arial,verdana", this.o.style.overflow = "hidden", this.o.style.fontWeight = "normal", this.o.style.zIndex = l.zIndex, p.appendChild(this.o), this.refresh = function() {
        if (isNaN(s.x) || isNaN(s.y)) return !1;
        s.o.style.left = s.x + "px", s.o.style.top = s.y + "px"
      }, this.stick = function() {
        m || l.targetElement != document.documentElement && l.targetElement != document.body ? s.o.style.top = d + u - l.flakeHeight + "px" : l.flakeBottom ? s.o.style.top = l.flakeBottom + "px" : (s.o.style.display = "none", s.o.style.top = "auto", s.o.style.bottom = "0px", s.o.style.position = "fixed", s.o.style.display = "block")
      }, this.vCheck = function() {
        s.vX >= 0 && s.vX < .2 ? s.vX = .2 : s.vX < 0 && s.vX > -.2 && (s.vX = -.2), s.vY >= 0 && s.vY < .2 && (s.vY = .2)
      }, this.move = function() {
        var e = s.vX * g;
        s.x += e, s.y += s.vY * s.vAmp, s.x >= h || h - s.x < l.flakeWidth ? s.x = 0 : e < 0 && s.x - l.flakeLeftOffset < 0 - l.flakeWidth && (s.x = h - l.flakeWidth - 1), s.refresh(), d + u - s.y < l.flakeHeight ? (s.active = 0, l.snowStick ? s.stick() : s.recycle()) : (l.useMeltEffect && s.active && s.type < 3 && !s.melting && Math.random() > .998 && (s.melting = !0, s.melt()), l.useTwinkleEffect && (s.twinkleFrame ? (s.twinkleFrame--, s.o.style.visibility = s.twinkleFrame && s.twinkleFrame % 2 == 0 ? "hidden" : "visible") : Math.random() > .9 && (s.twinkleFrame = parseInt(20 * Math.random(), 10))))
      }, this.animate = function() {
        s.move()
      }, this.setVelocities = function() {
        s.vX = v + i(.12 * l.vMaxX, .1), s.vY = k + i(.12 * l.vMaxY, .1)
      }, this.setOpacity = function(e, t) {
        if (!y) return !1;
        e.style.opacity = t
      }, this.melt = function() {
        l.useMeltEffect && s.melting && s.meltFrame < s.meltFrameCount ? (s.meltFrame++, s.setOpacity(s.o, s.meltFrames[s.meltFrame]), s.o.style.fontSize = s.fontSize - s.fontSize * (s.meltFrame / s.meltFrameCount) + "px", s.o.style.lineHeight = l.flakeHeight + 2 + .75 * l.flakeHeight * (s.meltFrame / s.meltFrameCount) + "px") : s.recycle()
      }, this.recycle = function() {
        s.o.style.display = "none", s.o.style.position = w ? "fixed" : "absolute", s.o.style.bottom = "auto", s.setVelocities(), s.vCheck(), s.meltFrame = 0, s.melting = !1, s.setOpacity(s.o, 1), s.o.style.padding = "0px", s.o.style.margin = "0px", s.o.style.fontSize = s.fontSize + "px", s.o.style.lineHeight = l.flakeHeight + 2 + "px", s.o.style.textAlign = "center", s.o.style.verticalAlign = "baseline", s.x = parseInt(i(h - l.flakeWidth - 20), 10), s.y = parseInt(-1 * i(d), 10) - l.flakeHeight, s.refresh(), s.o.style.display = "block", s.active = 1
      }, this.recycle(), this.refresh()
    }, this.snow = function() {
      for (var e = 0, t = null, o = n.flakes.length; o--;) 1 == n.flakes[o].active ? (n.flakes[o].move(), e++) : 0 === n.flakes[o].active ? 0 : 0, n.flakes[o].melting && n.flakes[o].melt();
      e < n.flakesMaxActive && 0 === (t = n.flakes[parseInt(i(n.flakes.length), 10)]).active && (t.melting = !0)
    }, this.mouseMove = function(e) {
      if (!n.followMouse) return !0;
      var t = parseInt(e.clientX, 10);
      g = t < c ? t / c * 2 - 2 : (t -= c) / c * 2
    }, this.createSnow = function(e, t) {
      for (var s = 0; s < e; s++) n.flakes[n.flakes.length] = new n.SnowFlake(n, parseInt(i(6), 10)), (t || s > n.flakesMaxActive) && (n.flakes[n.flakes.length - 1].active = -1);
      o.targetElement.appendChild(p)
    }, this.timerInit = function() {
      n.timers = r ? [setInterval(n.snow, 3 * n.animationInterval), setInterval(n.snow, n.animationInterval)] : [setInterval(n.snow, n.animationInterval)]
    }, this.init = function() {
      n.randomizeWind(), n.createSnow(n.flakesMax), e(window, "resize", n.resizeHandler), e(window, "scroll", n.scrollHandler), a || (e(window, "blur", n.freeze), e(window, "focus", n.resume)), n.resizeHandler(), n.scrollHandler(), n.followMouse && e(document, "mousemove", n.mouseMove), n.animationInterval = Math.max(20, n.animationInterval), n.timerInit()
    };
    var E = !1;

    function F() {
      n.start(!0)
    }
    this.start = function(e) {
      if (E) {
        if (e) return !0
      } else E = !0;
      if ("string" == typeof n.targetElement) {
        var t = n.targetElement;
        if (n.targetElement = document.getElementById(t), !n.targetElement) throw new Error('Snowstorm: Unable to get targetElement "' + t + '"')
      }
      n.targetElement || (n.targetElement = s ? document.body : document.documentElement ? document.documentElement : document.body), n.targetElement != document.documentElement && n.targetElement != document.body && (n.resizeHandler = n.resizeHandlerAlt), n.resizeHandler(), n.usePositionFixed = n.usePositionFixed && !m, w = n.usePositionFixed, h && d && !n.disabled && (n.init(), n.active = !0)
    }, document.addEventListener ? (document.addEventListener("DOMContentLoaded", F, !1), window.addEventListener("load", F, !1)) : e(window, "load", F)
  }
  snowStorm = new SnowStorm;
  //]]>
</script>

<script type='text/javascript'>
  //<![CDATA[
  var snowStorm = null;

  function SnowStorm() {
    this.flakesMax = 200, this.flakesMaxActive = 100, this.animationInterval = 33, this.flakeBottom = null, this.targetElement = null, this.followMouse = true, this.snowColor = "#EC255A", this.snowCharacter = "&bull;", this.snowStick = !0, this.useMeltEffect = !0, this.useTwinkleEffect = !1, this.usePositionFixed = !1, this.flakeLeftOffset = 0, this.flakeRightOffset = 0, this.flakeWidth = 8, this.flakeHeight = 8, this.vMaxX = 5, this.vMaxY = 10, this.zIndex = 0;
    var e = void 0 === window.attachEvent ? function(e, t, i) {
        return e.addEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.attachEvent("on" + t, i)
      },
      t = void 0 === window.attachEvent ? function(e, t, i) {
        return e.removeEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.detachEvent("on" + t, i)
      };

    function i(e, t) {
      return isNaN(t) && (t = 0), Math.random() * e + t
    }
    var n = this,
      o = this;
    this.timers = [], this.flakes = [], this.disabled = !1, this.active = !1;
    var s = navigator.userAgent.match(/msie/i),
      l = navigator.userAgent.match(/msie 6/i),
      a = s && (l || navigator.userAgent.match(/msie 5/i)),
      r = navigator.appVersion.match(/windows 98/i),
      f = navigator.userAgent.match(/iphone/i),
      m = !!(s && "BackCompat" == document.compatMode || l || f),
      h = null,
      c = null,
      d = null,
      u = null,
      v = null,
      k = null,
      g = 1,
      w = !1,
      y = function() {
        try {
          document.createElement("div").style.opacity = "1.7"
        } catch (e) {
          return !1
        }
        return !0
      }(),
      p = document.createDocumentFragment();
    null === n.flakeLeftOffset && (n.flakeLeftOffset = 0), null === n.flakeRightOffset && (n.flakeRightOffset = 0), this.meltFrameCount = 20, this.meltFrames = [];
    for (var x = 0; x < this.meltFrameCount; x++) this.meltFrames.push(1 - x / this.meltFrameCount);
    this.randomizeWind = function() {
      var e;
      if (e = i(n.vMaxX, .2), v = 1 == parseInt(i(2), 10) ? -1 * e : e, k = i(n.vMaxY, .2), this.flakes)
        for (var t = 0; t < this.flakes.length; t++) this.flakes[t].active && this.flakes[t].setVelocities()
    }, this.scrollHandler = function() {
      if (u = n.flakeBottom ? 0 : parseInt(window.scrollY || document.documentElement.scrollTop || document.body.scrollTop, 10), isNaN(u) && (u = 0), !w && !n.flakeBottom && n.flakes)
        for (var e = n.flakes.length; e--;) 0 === n.flakes[e].active && n.flakes[e].stick()
    }, this.resizeHandler = function() {
      window.innerWidth || window.innerHeight ? (h = window.innerWidth - (s ? 2 : 16) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : window.innerHeight) : (h = (document.documentElement.clientWidth || document.body.clientWidth || document.body.scrollWidth) - (s ? 0 : 8) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : document.documentElement.clientHeight || document.body.clientHeight || document.body.scrollHeight), c = parseInt(h / 2, 10)
    }, this.resizeHandlerAlt = function() {
      h = n.targetElement.offsetLeft + n.targetElement.offsetWidth - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : n.targetElement.offsetTop + n.targetElement.offsetHeight, c = parseInt(h / 2, 10)
    }, this.freeze = function() {
      if (n.disabled) return !1;
      n.disabled = 1;
      for (var e = n.timers.length; e--;) clearInterval(n.timers[e])
    }, this.resume = function() {
      if (!n.disabled) return !1;
      n.disabled = 0, n.timerInit()
    }, this.toggleSnow = function() {
      n.flakes.length ? (n.active = !n.active, n.active ? (n.show(), n.resume()) : (n.stop(), n.freeze())) : n.start()
    }, this.stop = function() {
      this.freeze();
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "none";
      t(window, "scroll", n.scrollHandler), t(window, "resize", n.resizeHandler), a || (t(window, "blur", n.freeze), t(window, "focus", n.resume))
    }, this.show = function() {
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "block"
    }, this.SnowFlake = function(e, t, n, o) {
      var s = this,
        l = e;
      this.type = t, this.x = n || parseInt(i(h - 20), 10), this.y = isNaN(o) ? -i(d) - 12 : o, this.vX = null, this.vY = null, this.vAmpTypes = [1, 1.2, 1.4, 1.6, 1.8], this.vAmp = this.vAmpTypes[this.type], this.melting = !1, this.meltFrameCount = l.meltFrameCount, this.meltFrames = l.meltFrames, this.meltFrame = 0, this.twinkleFrame = 0, this.active = 1, this.fontSize = 10 + this.type / 5 * 10, this.o = document.createElement("div"), this.o.innerHTML = l.snowCharacter, this.o.style.color = l.snowColor, this.o.style.position = w ? "fixed" : "absolute", this.o.style.width = l.flakeWidth + "px", this.o.style.height = l.flakeHeight + "px", this.o.style.fontFamily = "arial,verdana", this.o.style.overflow = "hidden", this.o.style.fontWeight = "normal", this.o.style.zIndex = l.zIndex, p.appendChild(this.o), this.refresh = function() {
        if (isNaN(s.x) || isNaN(s.y)) return !1;
        s.o.style.left = s.x + "px", s.o.style.top = s.y + "px"
      }, this.stick = function() {
        m || l.targetElement != document.documentElement && l.targetElement != document.body ? s.o.style.top = d + u - l.flakeHeight + "px" : l.flakeBottom ? s.o.style.top = l.flakeBottom + "px" : (s.o.style.display = "none", s.o.style.top = "auto", s.o.style.bottom = "0px", s.o.style.position = "fixed", s.o.style.display = "block")
      }, this.vCheck = function() {
        s.vX >= 0 && s.vX < .2 ? s.vX = .2 : s.vX < 0 && s.vX > -.2 && (s.vX = -.2), s.vY >= 0 && s.vY < .2 && (s.vY = .2)
      }, this.move = function() {
        var e = s.vX * g;
        s.x += e, s.y += s.vY * s.vAmp, s.x >= h || h - s.x < l.flakeWidth ? s.x = 0 : e < 0 && s.x - l.flakeLeftOffset < 0 - l.flakeWidth && (s.x = h - l.flakeWidth - 1), s.refresh(), d + u - s.y < l.flakeHeight ? (s.active = 0, l.snowStick ? s.stick() : s.recycle()) : (l.useMeltEffect && s.active && s.type < 3 && !s.melting && Math.random() > .998 && (s.melting = !0, s.melt()), l.useTwinkleEffect && (s.twinkleFrame ? (s.twinkleFrame--, s.o.style.visibility = s.twinkleFrame && s.twinkleFrame % 2 == 0 ? "hidden" : "visible") : Math.random() > .9 && (s.twinkleFrame = parseInt(20 * Math.random(), 10))))
      }, this.animate = function() {
        s.move()
      }, this.setVelocities = function() {
        s.vX = v + i(.12 * l.vMaxX, .1), s.vY = k + i(.12 * l.vMaxY, .1)
      }, this.setOpacity = function(e, t) {
        if (!y) return !1;
        e.style.opacity = t
      }, this.melt = function() {
        l.useMeltEffect && s.melting && s.meltFrame < s.meltFrameCount ? (s.meltFrame++, s.setOpacity(s.o, s.meltFrames[s.meltFrame]), s.o.style.fontSize = s.fontSize - s.fontSize * (s.meltFrame / s.meltFrameCount) + "px", s.o.style.lineHeight = l.flakeHeight + 2 + .75 * l.flakeHeight * (s.meltFrame / s.meltFrameCount) + "px") : s.recycle()
      }, this.recycle = function() {
        s.o.style.display = "none", s.o.style.position = w ? "fixed" : "absolute", s.o.style.bottom = "auto", s.setVelocities(), s.vCheck(), s.meltFrame = 0, s.melting = !1, s.setOpacity(s.o, 1), s.o.style.padding = "0px", s.o.style.margin = "0px", s.o.style.fontSize = s.fontSize + "px", s.o.style.lineHeight = l.flakeHeight + 2 + "px", s.o.style.textAlign = "center", s.o.style.verticalAlign = "baseline", s.x = parseInt(i(h - l.flakeWidth - 20), 10), s.y = parseInt(-1 * i(d), 10) - l.flakeHeight, s.refresh(), s.o.style.display = "block", s.active = 1
      }, this.recycle(), this.refresh()
    }, this.snow = function() {
      for (var e = 0, t = null, o = n.flakes.length; o--;) 1 == n.flakes[o].active ? (n.flakes[o].move(), e++) : 0 === n.flakes[o].active ? 0 : 0, n.flakes[o].melting && n.flakes[o].melt();
      e < n.flakesMaxActive && 0 === (t = n.flakes[parseInt(i(n.flakes.length), 10)]).active && (t.melting = !0)
    }, this.mouseMove = function(e) {
      if (!n.followMouse) return !0;
      var t = parseInt(e.clientX, 10);
      g = t < c ? t / c * 2 - 2 : (t -= c) / c * 2
    }, this.createSnow = function(e, t) {
      for (var s = 0; s < e; s++) n.flakes[n.flakes.length] = new n.SnowFlake(n, parseInt(i(6), 10)), (t || s > n.flakesMaxActive) && (n.flakes[n.flakes.length - 1].active = -1);
      o.targetElement.appendChild(p)
    }, this.timerInit = function() {
      n.timers = r ? [setInterval(n.snow, 3 * n.animationInterval), setInterval(n.snow, n.animationInterval)] : [setInterval(n.snow, n.animationInterval)]
    }, this.init = function() {
      n.randomizeWind(), n.createSnow(n.flakesMax), e(window, "resize", n.resizeHandler), e(window, "scroll", n.scrollHandler), a || (e(window, "blur", n.freeze), e(window, "focus", n.resume)), n.resizeHandler(), n.scrollHandler(), n.followMouse && e(document, "mousemove", n.mouseMove), n.animationInterval = Math.max(20, n.animationInterval), n.timerInit()
    };
    var E = !1;

    function F() {
      n.start(!0)
    }
    this.start = function(e) {
      if (E) {
        if (e) return !0
      } else E = !0;
      if ("string" == typeof n.targetElement) {
        var t = n.targetElement;
        if (n.targetElement = document.getElementById(t), !n.targetElement) throw new Error('Snowstorm: Unable to get targetElement "' + t + '"')
      }
      n.targetElement || (n.targetElement = s ? document.body : document.documentElement ? document.documentElement : document.body), n.targetElement != document.documentElement && n.targetElement != document.body && (n.resizeHandler = n.resizeHandlerAlt), n.resizeHandler(), n.usePositionFixed = n.usePositionFixed && !m, w = n.usePositionFixed, h && d && !n.disabled && (n.init(), n.active = !0)
    }, document.addEventListener ? (document.addEventListener("DOMContentLoaded", F, !1), window.addEventListener("load", F, !1)) : e(window, "load", F)
  }
  snowStorm = new SnowStorm;
  //]]>
</script>

<script type='text/javascript'>
  //<![CDATA[
  var snowStorm = null;

  function SnowStorm() {
    this.flakesMax = 200, this.flakesMaxActive = 100, this.animationInterval = 33, this.flakeBottom = null, this.targetElement = null, this.followMouse = true, this.snowColor = "#519259", this.snowCharacter = "&bull;", this.snowStick = !0, this.useMeltEffect = !0, this.useTwinkleEffect = !1, this.usePositionFixed = !1, this.flakeLeftOffset = 0, this.flakeRightOffset = 0, this.flakeWidth = 8, this.flakeHeight = 8, this.vMaxX = 5, this.vMaxY = 10, this.zIndex = 0;
    var e = void 0 === window.attachEvent ? function(e, t, i) {
        return e.addEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.attachEvent("on" + t, i)
      },
      t = void 0 === window.attachEvent ? function(e, t, i) {
        return e.removeEventListener(t, i, !1)
      } : function(e, t, i) {
        return e.detachEvent("on" + t, i)
      };

    function i(e, t) {
      return isNaN(t) && (t = 0), Math.random() * e + t
    }
    var n = this,
      o = this;
    this.timers = [], this.flakes = [], this.disabled = !1, this.active = !1;
    var s = navigator.userAgent.match(/msie/i),
      l = navigator.userAgent.match(/msie 6/i),
      a = s && (l || navigator.userAgent.match(/msie 5/i)),
      r = navigator.appVersion.match(/windows 98/i),
      f = navigator.userAgent.match(/iphone/i),
      m = !!(s && "BackCompat" == document.compatMode || l || f),
      h = null,
      c = null,
      d = null,
      u = null,
      v = null,
      k = null,
      g = 1,
      w = !1,
      y = function() {
        try {
          document.createElement("div").style.opacity = "1.7"
        } catch (e) {
          return !1
        }
        return !0
      }(),
      p = document.createDocumentFragment();
    null === n.flakeLeftOffset && (n.flakeLeftOffset = 0), null === n.flakeRightOffset && (n.flakeRightOffset = 0), this.meltFrameCount = 20, this.meltFrames = [];
    for (var x = 0; x < this.meltFrameCount; x++) this.meltFrames.push(1 - x / this.meltFrameCount);
    this.randomizeWind = function() {
      var e;
      if (e = i(n.vMaxX, .2), v = 1 == parseInt(i(2), 10) ? -1 * e : e, k = i(n.vMaxY, .2), this.flakes)
        for (var t = 0; t < this.flakes.length; t++) this.flakes[t].active && this.flakes[t].setVelocities()
    }, this.scrollHandler = function() {
      if (u = n.flakeBottom ? 0 : parseInt(window.scrollY || document.documentElement.scrollTop || document.body.scrollTop, 10), isNaN(u) && (u = 0), !w && !n.flakeBottom && n.flakes)
        for (var e = n.flakes.length; e--;) 0 === n.flakes[e].active && n.flakes[e].stick()
    }, this.resizeHandler = function() {
      window.innerWidth || window.innerHeight ? (h = window.innerWidth - (s ? 2 : 16) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : window.innerHeight) : (h = (document.documentElement.clientWidth || document.body.clientWidth || document.body.scrollWidth) - (s ? 0 : 8) - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : document.documentElement.clientHeight || document.body.clientHeight || document.body.scrollHeight), c = parseInt(h / 2, 10)
    }, this.resizeHandlerAlt = function() {
      h = n.targetElement.offsetLeft + n.targetElement.offsetWidth - n.flakeRightOffset, d = n.flakeBottom ? n.flakeBottom : n.targetElement.offsetTop + n.targetElement.offsetHeight, c = parseInt(h / 2, 10)
    }, this.freeze = function() {
      if (n.disabled) return !1;
      n.disabled = 1;
      for (var e = n.timers.length; e--;) clearInterval(n.timers[e])
    }, this.resume = function() {
      if (!n.disabled) return !1;
      n.disabled = 0, n.timerInit()
    }, this.toggleSnow = function() {
      n.flakes.length ? (n.active = !n.active, n.active ? (n.show(), n.resume()) : (n.stop(), n.freeze())) : n.start()
    }, this.stop = function() {
      this.freeze();
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "none";
      t(window, "scroll", n.scrollHandler), t(window, "resize", n.resizeHandler), a || (t(window, "blur", n.freeze), t(window, "focus", n.resume))
    }, this.show = function() {
      for (var e = this.flakes.length; e--;) this.flakes[e].o.style.display = "block"
    }, this.SnowFlake = function(e, t, n, o) {
      var s = this,
        l = e;
      this.type = t, this.x = n || parseInt(i(h - 20), 10), this.y = isNaN(o) ? -i(d) - 12 : o, this.vX = null, this.vY = null, this.vAmpTypes = [1, 1.2, 1.4, 1.6, 1.8], this.vAmp = this.vAmpTypes[this.type], this.melting = !1, this.meltFrameCount = l.meltFrameCount, this.meltFrames = l.meltFrames, this.meltFrame = 0, this.twinkleFrame = 0, this.active = 1, this.fontSize = 10 + this.type / 5 * 10, this.o = document.createElement("div"), this.o.innerHTML = l.snowCharacter, this.o.style.color = l.snowColor, this.o.style.position = w ? "fixed" : "absolute", this.o.style.width = l.flakeWidth + "px", this.o.style.height = l.flakeHeight + "px", this.o.style.fontFamily = "arial,verdana", this.o.style.overflow = "hidden", this.o.style.fontWeight = "normal", this.o.style.zIndex = l.zIndex, p.appendChild(this.o), this.refresh = function() {
        if (isNaN(s.x) || isNaN(s.y)) return !1;
        s.o.style.left = s.x + "px", s.o.style.top = s.y + "px"
      }, this.stick = function() {
        m || l.targetElement != document.documentElement && l.targetElement != document.body ? s.o.style.top = d + u - l.flakeHeight + "px" : l.flakeBottom ? s.o.style.top = l.flakeBottom + "px" : (s.o.style.display = "none", s.o.style.top = "auto", s.o.style.bottom = "0px", s.o.style.position = "fixed", s.o.style.display = "block")
      }, this.vCheck = function() {
        s.vX >= 0 && s.vX < .2 ? s.vX = .2 : s.vX < 0 && s.vX > -.2 && (s.vX = -.2), s.vY >= 0 && s.vY < .2 && (s.vY = .2)
      }, this.move = function() {
        var e = s.vX * g;
        s.x += e, s.y += s.vY * s.vAmp, s.x >= h || h - s.x < l.flakeWidth ? s.x = 0 : e < 0 && s.x - l.flakeLeftOffset < 0 - l.flakeWidth && (s.x = h - l.flakeWidth - 1), s.refresh(), d + u - s.y < l.flakeHeight ? (s.active = 0, l.snowStick ? s.stick() : s.recycle()) : (l.useMeltEffect && s.active && s.type < 3 && !s.melting && Math.random() > .998 && (s.melting = !0, s.melt()), l.useTwinkleEffect && (s.twinkleFrame ? (s.twinkleFrame--, s.o.style.visibility = s.twinkleFrame && s.twinkleFrame % 2 == 0 ? "hidden" : "visible") : Math.random() > .9 && (s.twinkleFrame = parseInt(20 * Math.random(), 10))))
      }, this.animate = function() {
        s.move()
      }, this.setVelocities = function() {
        s.vX = v + i(.12 * l.vMaxX, .1), s.vY = k + i(.12 * l.vMaxY, .1)
      }, this.setOpacity = function(e, t) {
        if (!y) return !1;
        e.style.opacity = t
      }, this.melt = function() {
        l.useMeltEffect && s.melting && s.meltFrame < s.meltFrameCount ? (s.meltFrame++, s.setOpacity(s.o, s.meltFrames[s.meltFrame]), s.o.style.fontSize = s.fontSize - s.fontSize * (s.meltFrame / s.meltFrameCount) + "px", s.o.style.lineHeight = l.flakeHeight + 2 + .75 * l.flakeHeight * (s.meltFrame / s.meltFrameCount) + "px") : s.recycle()
      }, this.recycle = function() {
        s.o.style.display = "none", s.o.style.position = w ? "fixed" : "absolute", s.o.style.bottom = "auto", s.setVelocities(), s.vCheck(), s.meltFrame = 0, s.melting = !1, s.setOpacity(s.o, 1), s.o.style.padding = "0px", s.o.style.margin = "0px", s.o.style.fontSize = s.fontSize + "px", s.o.style.lineHeight = l.flakeHeight + 2 + "px", s.o.style.textAlign = "center", s.o.style.verticalAlign = "baseline", s.x = parseInt(i(h - l.flakeWidth - 20), 10), s.y = parseInt(-1 * i(d), 10) - l.flakeHeight, s.refresh(), s.o.style.display = "block", s.active = 1
      }, this.recycle(), this.refresh()
    }, this.snow = function() {
      for (var e = 0, t = null, o = n.flakes.length; o--;) 1 == n.flakes[o].active ? (n.flakes[o].move(), e++) : 0 === n.flakes[o].active ? 0 : 0, n.flakes[o].melting && n.flakes[o].melt();
      e < n.flakesMaxActive && 0 === (t = n.flakes[parseInt(i(n.flakes.length), 10)]).active && (t.melting = !0)
    }, this.mouseMove = function(e) {
      if (!n.followMouse) return !0;
      var t = parseInt(e.clientX, 10);
      g = t < c ? t / c * 2 - 2 : (t -= c) / c * 2
    }, this.createSnow = function(e, t) {
      for (var s = 0; s < e; s++) n.flakes[n.flakes.length] = new n.SnowFlake(n, parseInt(i(6), 10)), (t || s > n.flakesMaxActive) && (n.flakes[n.flakes.length - 1].active = -1);
      o.targetElement.appendChild(p)
    }, this.timerInit = function() {
      n.timers = r ? [setInterval(n.snow, 3 * n.animationInterval), setInterval(n.snow, n.animationInterval)] : [setInterval(n.snow, n.animationInterval)]
    }, this.init = function() {
      n.randomizeWind(), n.createSnow(n.flakesMax), e(window, "resize", n.resizeHandler), e(window, "scroll", n.scrollHandler), a || (e(window, "blur", n.freeze), e(window, "focus", n.resume)), n.resizeHandler(), n.scrollHandler(), n.followMouse && e(document, "mousemove", n.mouseMove), n.animationInterval = Math.max(20, n.animationInterval), n.timerInit()
    };
    var E = !1;

    function F() {
      n.start(!0)
    }
    this.start = function(e) {
      if (E) {
        if (e) return !0
      } else E = !0;
      if ("string" == typeof n.targetElement) {
        var t = n.targetElement;
        if (n.targetElement = document.getElementById(t), !n.targetElement) throw new Error('Snowstorm: Unable to get targetElement "' + t + '"')
      }
      n.targetElement || (n.targetElement = s ? document.body : document.documentElement ? document.documentElement : document.body), n.targetElement != document.documentElement && n.targetElement != document.body && (n.resizeHandler = n.resizeHandlerAlt), n.resizeHandler(), n.usePositionFixed = n.usePositionFixed && !m, w = n.usePositionFixed, h && d && !n.disabled && (n.init(), n.active = !0)
    }, document.addEventListener ? (document.addEventListener("DOMContentLoaded", F, !1), window.addEventListener("load", F, !1)) : e(window, "load", F)
  }
  snowStorm = new SnowStorm;
  //]]>
</script>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    include 'template/sidebar_menu.php';
    ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->

        <?php
        include 'template/topbar_menu.php';
        ?>

        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">My Profile</h1>
          </div>
          <div class="row">
            <!-- Content Column -->
            <div class="card mb-4 shadow-lg p-3 bg-body rounded" style="max-width: 700px;">
              <div class="card" style="width: 18rem;">
                <img src="../img/fotosiswa/<?= $data['image']; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h6 class="card-title">Name : <?= $data['name']; ?></h6>
                  <h6 class="card-title">Username : <?= $data['username']; ?></h6>
                  <h6 class="card-title">Password : <?= $data['password']; ?></h6>
                  <a id="edit_siswa" data-toggle="modal" data-target="#edit" data-foto="<?= $data["image"]; ?>" data-nis="<?= $data["nis"]; ?>" data-nama="<?= $data["name"]; ?>" data-username="<?= $data["username"]; ?>" data-password="<?= $data["password"]; ?>">
                    <button class="btn btn-info btn-warning">Ganti Password</button></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->

      <?php
      include 'template/footer.php';
      ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php
  include 'modal/modal_profile.php';
  include 'modal/modal_logout.php';
  ?>
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>
  <script>
    $(document).on("click", "#edit_siswa", function() {
      let image = $(this).data('foto');
      let nis = $(this).data('nis');
      let name = $(this).data('nama');
      let username = $(this).data('username');
      let password = $(this).data('password');
      $(" #modal-edit #nis").val(nis);
      $(" #modal-edit #name").val(name);
      $(" #modal-edit #username").val(username);
      $(" #modal-edit #password").val(password);
      $(" #modal-edit #image").attr("src", "../img/fotosiswa/" + image);
    });
  </script>
  <script>
    $(document).ready(function() {
      var living = document.getElementById('living');
      var waktu = new Date();
      var hari = waktu.getDay();
      var bulan = waktu.getMonth();


      if (hari == 7) {
        living.style.display = 'blok';
      } else {
        living.style.display = 'none';
      }
    });
  </script>
</body>


</html>