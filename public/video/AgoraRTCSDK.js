/*! AgoraRTC|BUILD v2.5.0-beta-319-g4ef68b8-dirty */ ! function(e, t) {
    "object" == typeof exports && "object" == typeof module ? module.exports = t() : "function" == typeof define && define.amd ? define("AgoraRTC", [], t) : "object" == typeof exports ? exports.AgoraRTC = t() : e.AgoraRTC = t()
}(window, function() {
    return function(e) {
        var t = {};

        function i(n) {
            if (t[n]) return t[n].exports;
            var o = t[n] = {
                i: n,
                l: !1,
                exports: {}
            };
            return e[n].call(o.exports, o, o.exports, i), o.l = !0, o.exports
        }
        return i.m = e, i.c = t, i.d = function(e, t, n) {
            i.o(e, t) || Object.defineProperty(e, t, {
                enumerable: !0,
                get: n
            })
        }, i.r = function(e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {
                value: "Module"
            }), Object.defineProperty(e, "__esModule", {
                value: !0
            })
        }, i.t = function(e, t) {
            if (1 & t && (e = i(e)), 8 & t) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var n = Object.create(null);
            if (i.r(n), Object.defineProperty(n, "default", {
                    enumerable: !0,
                    value: e
                }), 2 & t && "string" != typeof e)
                for (var o in e) i.d(n, o, function(t) {
                    return e[t]
                }.bind(null, o));
            return n
        }, i.n = function(e) {
            var t = e && e.__esModule ? function() {
                return e.default
            } : function() {
                return e
            };
            return i.d(t, "a", t), t
        }, i.o = function(e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, i.p = "", i(i.s = 7)
    }([function(e, t) {
        function i() {
            return e.exports = i = Object.assign || function(e) {
                for (var t = 1; t < arguments.length; t++) {
                    var i = arguments[t];
                    for (var n in i) Object.prototype.hasOwnProperty.call(i, n) && (e[n] = i[n])
                }
                return e
            }, i.apply(this, arguments)
        }
        e.exports = i
    }, function(e, t) {
        function i(e) {
            return (i = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function(e) {
                return typeof e
            } : function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        function n(t) {
            return "function" == typeof Symbol && "symbol" === i(Symbol.iterator) ? e.exports = n = function(e) {
                return i(e)
            } : e.exports = n = function(e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : i(e)
            }, n(t)
        }
        e.exports = n
    }, function(e, t, i) {
        var n = i(6);
        e.exports = function(e) {
            for (var t = 1; t < arguments.length; t++) {
                var i = null != arguments[t] ? arguments[t] : {},
                    o = Object.keys(i);
                "function" == typeof Object.getOwnPropertySymbols && (o = o.concat(Object.getOwnPropertySymbols(i).filter(function(e) {
                    return Object.getOwnPropertyDescriptor(i, e).enumerable
                }))), o.forEach(function(t) {
                    n(e, t, i[t])
                })
            }
            return e
        }
    }, function(e, t, i) {
        var n = i(4),
            o = i(5);
        e.exports = function(e, t, i) {
            var r = t && i || 0;
            "string" == typeof e && (t = "binary" === e ? new Array(16) : null, e = null);
            var a = (e = e || {}).random || (e.rng || n)();
            if (a[6] = 15 & a[6] | 64, a[8] = 63 & a[8] | 128, t)
                for (var s = 0; s < 16; ++s) t[r + s] = a[s];
            return t || o(a)
        }
    }, function(e, t) {
        var i = "undefined" != typeof crypto && crypto.getRandomValues && crypto.getRandomValues.bind(crypto) || "undefined" != typeof msCrypto && "function" == typeof window.msCrypto.getRandomValues && msCrypto.getRandomValues.bind(msCrypto);
        if (i) {
            var n = new Uint8Array(16);
            e.exports = function() {
                return i(n), n
            }
        } else {
            var o = new Array(16);
            e.exports = function() {
                for (var e, t = 0; t < 16; t++) 0 == (3 & t) && (e = 4294967296 * Math.random()), o[t] = e >>> ((3 & t) << 3) & 255;
                return o
            }
        }
    }, function(e, t) {
        for (var i = [], n = 0; n < 256; ++n) i[n] = (n + 256).toString(16).substr(1);
        e.exports = function(e, t) {
            var n = t || 0,
                o = i;
            return [o[e[n++]], o[e[n++]], o[e[n++]], o[e[n++]], "-", o[e[n++]], o[e[n++]], "-", o[e[n++]], o[e[n++]], "-", o[e[n++]], o[e[n++]], "-", o[e[n++]], o[e[n++]], o[e[n++]], o[e[n++]], o[e[n++]], o[e[n++]]].join("")
        }
    }, function(e, t) {
        e.exports = function(e, t, i) {
            return t in e ? Object.defineProperty(e, t, {
                value: i,
                enumerable: !0,
                configurable: !0,
                writable: !0
            }) : e[t] = i, e
        }
    }, function(e, t, i) {
        "use strict";
        i.r(t);
        var n = "v2.5.0-beta-319-g4ef68b8-dirty",
            o = ["ap-web-1.agora.io", "ap-web-2.agoraio.cn"],
            r = ["ap-web-3.agora.io", "ap-web-4.agoraio.cn"],
            a = ["ap-proxy-1.agora.io", "ap-proxy-2.agora.io"],
            s = {
                "90p_1": [160, 90],
                "120p_1": [160, 120],
                "120p_3": [120, 120],
                "120p_4": [212, 120],
                "180p_1": [320, 180],
                "180p_3": [180, 180],
                "180p_4": [240, 180],
                "240p_1": [320, 240],
                "240p_3": [240, 240],
                "240p_4": [424, 240],
                "360p_1": [640, 360],
                "360p_3": [360, 360],
                "360p_4": [640, 360],
                "360p_6": [360, 360],
                "360p_7": [480, 360],
                "360p_8": [480, 360],
                "360p_9": [640, 360],
                "360p_10": [640, 360],
                "360p_11": [640, 360],
                "480p_1": [640, 480],
                "480p_2": [640, 480],
                "480p_3": [480, 480],
                "480p_4": [640, 480],
                "480p_6": [480, 480],
                "480p_8": [848, 480],
                "480p_9": [848, 480],
                "480p_10": [640, 480],
                "720p_1": [1280, 720],
                "720p_2": [1280, 720],
                "720p_3": [1280, 720],
                "720p_5": [960, 720],
                "720p_6": [960, 720],
                "1080p_1": [1920, 1080],
                "1080p_2": [1920, 1080],
                "1080p_3": [1920, 1080],
                "1080p_5": [1920, 1080],
                "1440p_1": [2560, 1440],
                "1440p_2": [2560, 1440],
                "4k_1": [3840, 2160],
                "4k_3": [3840, 2160]
            },
            d = i(1),
            c = i.n(d),
            u = function() {
                var e = S();
                return e.name && "Chrome" === e.name
            },
            l = function() {
                var e = S();
                return e.name && "Safari" === e.name
            },
            p = function() {
                var e = S();
                return e.name && "Firefox" === e.name
            },
            g = function() {
                var e = S();
                return e.name && "OPR" === e.name
            },
            m = function() {
                var e = S();
                return e.name && "MicroMessenger" === e.name
            },
            f = function() {
                return S().version
            },
            v = function() {
                return S().os
            },
            S = function() {
                var e = function() {
                    var e, t = navigator.userAgent,
                        i = t.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
                    "Chrome" === i[1] && null != (e = t.match(/(OPR(?=\/))\/?(\d+)/i)) && (i = e), "Safari" === i[1] && null != (e = t.match(/version\/(\d+)/i)) && (i[2] = e[1]), ~t.toLowerCase().indexOf("qqbrowser") && null != (e = t.match(/(qqbrowser(?=\/))\/?(\d+)/i)) && (i = e), ~t.toLowerCase().indexOf("micromessenger") && null != (e = t.match(/(micromessenger(?=\/))\/?(\d+)/i)) && (i = e), ~t.toLowerCase().indexOf("edge") && null != (e = t.match(/(edge(?=\/))\/?(\d+)/i)) && (i = e), ~t.toLowerCase().indexOf("trident") && null != (e = /\brv[ :]+(\d+)/g.exec(t) || []) && (i = [null, "IE", e[1]]);
                    var n = void 0,
                        o = [{
                            s: "Windows 10",
                            r: /(Windows 10.0|Windows NT 10.0)/
                        }, {
                            s: "Windows 8.1",
                            r: /(Windows 8.1|Windows NT 6.3)/
                        }, {
                            s: "Windows 8",
                            r: /(Windows 8|Windows NT 6.2)/
                        }, {
                            s: "Windows 7",
                            r: /(Windows 7|Windows NT 6.1)/
                        }, {
                            s: "Windows Vista",
                            r: /Windows NT 6.0/
                        }, {
                            s: "Windows Server 2003",
                            r: /Windows NT 5.2/
                        }, {
                            s: "Windows XP",
                            r: /(Windows NT 5.1|Windows XP)/
                        }, {
                            s: "Windows 2000",
                            r: /(Windows NT 5.0|Windows 2000)/
                        }, {
                            s: "Windows ME",
                            r: /(Win 9x 4.90|Windows ME)/
                        }, {
                            s: "Windows 98",
                            r: /(Windows 98|Win98)/
                        }, {
                            s: "Windows 95",
                            r: /(Windows 95|Win95|Windows_95)/
                        }, {
                            s: "Windows NT 4.0",
                            r: /(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/
                        }, {
                            s: "Windows CE",
                            r: /Windows CE/
                        }, {
                            s: "Windows 3.11",
                            r: /Win16/
                        }, {
                            s: "Android",
                            r: /Android/
                        }, {
                            s: "Open BSD",
                            r: /OpenBSD/
                        }, {
                            s: "Sun OS",
                            r: /SunOS/
                        }, {
                            s: "Linux",
                            r: /(Linux|X11)/
                        }, {
                            s: "iOS",
                            r: /(iPhone|iPad|iPod)/
                        }, {
                            s: "Mac OS X",
                            r: /Mac OS X/
                        }, {
                            s: "Mac OS",
                            r: /(MacPPC|MacIntel|Mac_PowerPC|Macintosh)/
                        }, {
                            s: "QNX",
                            r: /QNX/
                        }, {
                            s: "UNIX",
                            r: /UNIX/
                        }, {
                            s: "BeOS",
                            r: /BeOS/
                        }, {
                            s: "OS/2",
                            r: /OS\/2/
                        }, {
                            s: "Search Bot",
                            r: /(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/
                        }];
                    for (var r in o) {
                        var a = o[r];
                        if (a.r.test(navigator.userAgent)) {
                            n = a.s;
                            break
                        }
                    }
                    return {
                        name: i[1],
                        version: i[2],
                        os: n
                    }
                }();
                return function() {
                    return e
                }
            }(),
            _ = i(3),
            h = i.n(_),
            y = window.AudioContext || window.webkitAudioContext,
            I = function() {
                if (y) return new y;
                throw new Error("AUDIO_CONTEXT_NOT_SUPPORTED")
            },
            E = null,
            b = null,
            A = null,
            R = null,
            T = null,
            C = null,
            N = null,
            w = {
                addStream: null
            },
            O = {
                log: function() {},
                extractVersion: function(e, t, i) {
                    var n = e.match(t);
                    return n && n.length >= i && parseInt(n[i])
                }
            };
        if ("object" == ("undefined" == typeof window ? "undefined" : c()(window)) ? (!window.HTMLMediaElement || "srcObject" in window.HTMLMediaElement.prototype ? (T = function(e, t) {
                e.srcObject = t
            }, C = function(e) {
                return e.srcObject
            }) : (T = function(e, t) {
                "mozSrcObject" in e ? e.mozSrcObject = t : (e._srcObject = t, e.src = t ? URL.createObjectURL(t) : null)
            }, C = function(e) {
                return "mozSrcObject" in e ? e.mozSrcObject : e._srcObject
            }), E = window.navigator && window.navigator.getUserMedia) : (T = function(e, t) {
                e.srcObject = t
            }, C = function(e) {
                return e.srcObject
            }), b = function(e, t) {
                T(e, t)
            }, function(e, t) {
                T(e, C(t))
            }, "undefined" != typeof window && window.navigator)
            if (navigator.mozGetUserMedia && window.mozRTCPeerConnection) {
                for (var D in O.log("This appears to be Firefox"), "firefox", A = O.extractVersion(navigator.userAgent, /Firefox\/([0-9]+)\./, 1), 31, N = mozRTCPeerConnection, w) w[D] = N.prototype[D];
                if (R = function(e, t) {
                        if (A < 38 && e && e.iceServers) {
                            for (var i = [], n = 0; n < e.iceServers.length; n++) {
                                var o = e.iceServers[n];
                                if (o.hasOwnProperty("urls"))
                                    for (var r = 0; r < o.urls.length; r++) {
                                        var a = {
                                            url: o.urls[r]
                                        };
                                        0 === o.urls[r].indexOf("turn") && (a.username = o.username, a.credential = o.credential), i.push(a)
                                    } else i.push(e.iceServers[n])
                            }
                            e.iceServers = i
                        }
                        var s = new N(e, t);
                        for (var d in w) s[d] = w[d];
                        return s
                    }, window.RTCSessionDescription || (window.RTCSessionDescription = mozRTCSessionDescription), window.RTCIceCandidate || (window.RTCIceCandidate = mozRTCIceCandidate), E = function(e, t, i) {
                        var n = function(e) {
                            if ("object" !== c()(e) || e.require) return e;
                            var t = [];
                            return Object.keys(e).forEach(function(i) {
                                if ("require" !== i && "advanced" !== i && "mediaSource" !== i) {
                                    var n = e[i] = "object" === c()(e[i]) ? e[i] : {
                                        ideal: e[i]
                                    };
                                    if (void 0 === n.min && void 0 === n.max && void 0 === n.exact || t.push(i), void 0 !== n.exact && ("number" == typeof n.exact ? n.min = n.max = n.exact : e[i] = n.exact, delete n.exact), void 0 !== n.ideal) {
                                        e.advanced = e.advanced || [];
                                        var o = {};
                                        "number" == typeof n.ideal ? o[i] = {
                                            min: n.ideal,
                                            max: n.ideal
                                        } : o[i] = n.ideal, e.advanced.push(o), delete n.ideal, Object.keys(n).length || delete e[i]
                                    }
                                }
                            }), t.length && (e.require = t), e
                        };
                        return A < 38 && (O.log("spec: " + JSON.stringify(e)), e.audio && (e.audio = n(e.audio)), e.video && (e.video = n(e.video)), O.log("ff37: " + JSON.stringify(e))), navigator.mozGetUserMedia(e, t, i)
                    }, navigator.getUserMedia = E, navigator.mediaDevices || (navigator.mediaDevices = {
                        getUserMedia: x,
                        addEventListener: function() {},
                        removeEventListener: function() {}
                    }), navigator.mediaDevices.enumerateDevices = navigator.mediaDevices.enumerateDevices || function() {
                        return new Promise(function(e) {
                            e([{
                                kind: "audioinput",
                                deviceId: "default",
                                label: "",
                                groupId: ""
                            }, {
                                kind: "videoinput",
                                deviceId: "default",
                                label: "",
                                groupId: ""
                            }])
                        })
                    }, A < 41) {
                    var M = navigator.mediaDevices.enumerateDevices.bind(navigator.mediaDevices);
                    navigator.mediaDevices.enumerateDevices = function() {
                        return M().then(void 0, function(e) {
                            if ("NotFoundError" === e.name) return [];
                            throw e
                        })
                    }
                }
            } else if (navigator.webkitGetUserMedia && window.webkitRTCPeerConnection) {
            for (var D in O.log("This appears to be Chrome"), "chrome", A = O.extractVersion(navigator.userAgent, /Chrom(e|ium)\/([0-9]+)\./, 2), 38, N = webkitRTCPeerConnection, w) w[D] = N.prototype[D];
            R = function(e, t) {
                e && e.iceTransportPolicy && (e.iceTransports = e.iceTransportPolicy);
                var i = new N(e, t);
                for (var n in w) i[n] = w[n];
                var o = i.getStats.bind(i);
                return i.getStats = function(e, t, i) {
                    var n = this,
                        r = arguments;
                    if (arguments.length > 0 && "function" == typeof e) return o(e, t);
                    var a = function(e) {
                        var t = {};
                        return e.result().forEach(function(e) {
                            var i = {
                                id: e.id,
                                timestamp: e.timestamp,
                                type: e.type
                            };
                            e.names().forEach(function(t) {
                                i[t] = e.stat(t)
                            }), t[i.id] = i
                        }), t
                    };
                    if (arguments.length >= 2) {
                        return o.apply(this, [function(e) {
                            r[1](a(e))
                        }, arguments[0]])
                    }
                    return new Promise(function(t, i) {
                        1 === r.length && null === e ? o.apply(n, [function(e) {
                            t.apply(null, [a(e)])
                        }, i]) : o.apply(n, [t, i])
                    })
                }, i
            }, ["createOffer", "createAnswer"].forEach(function(e) {
                var t = webkitRTCPeerConnection.prototype[e];
                webkitRTCPeerConnection.prototype[e] = function() {
                    var e = this;
                    if (arguments.length < 1 || 1 === arguments.length && "object" === c()(arguments[0])) {
                        var i = 1 === arguments.length ? arguments[0] : void 0;
                        return new Promise(function(n, o) {
                            t.apply(e, [n, o, i])
                        })
                    }
                    return t.apply(this, arguments)
                }
            }), ["setLocalDescription", "setRemoteDescription", "addIceCandidate"].forEach(function(e) {
                var t = webkitRTCPeerConnection.prototype[e];
                webkitRTCPeerConnection.prototype[e] = function() {
                    var e = arguments,
                        i = this;
                    return new Promise(function(n, o) {
                        t.apply(i, [e[0], function() {
                            n(), e.length >= 2 && e[1].apply(null, [])
                        }, function(t) {
                            o(t), e.length >= 3 && e[2].apply(null, [t])
                        }])
                    })
                }
            });
            var k = function(e) {
                if ("object" !== c()(e) || e.mandatory || e.optional) return e;
                var t = {};
                return Object.keys(e).forEach(function(i) {
                    if ("require" !== i && "advanced" !== i && "mediaSource" !== i) {
                        var n = "object" === c()(e[i]) ? e[i] : {
                            ideal: e[i]
                        };
                        void 0 !== n.exact && "number" == typeof n.exact && (n.min = n.max = n.exact);
                        var o = function(e, t) {
                            return e ? e + t.charAt(0).toUpperCase() + t.slice(1) : "deviceId" === t ? "sourceId" : t
                        };
                        if (void 0 !== n.ideal) {
                            t.optional = t.optional || [];
                            var r = {};
                            "number" == typeof n.ideal ? (r[o("min", i)] = n.ideal, t.optional.push(r), (r = {})[o("max", i)] = n.ideal, t.optional.push(r)) : (r[o("", i)] = n.ideal, t.optional.push(r))
                        }
                        void 0 !== n.exact && "number" != typeof n.exact ? (t.mandatory = t.mandatory || {}, t.mandatory[o("", i)] = n.exact) : ["min", "max"].forEach(function(e) {
                            void 0 !== n[e] && (t.mandatory = t.mandatory || {}, t.mandatory[o(e, i)] = n[e])
                        })
                    }
                }), e.advanced && (t.optional = (t.optional || []).concat(e.advanced)), t
            };
            if (E = function(e, t, i) {
                    return e.audio && (e.audio = k(e.audio)), e.video && (e.video = k(e.video)), O.log("chrome: " + JSON.stringify(e)), navigator.webkitGetUserMedia(e, t, i)
                }, navigator.getUserMedia = E, navigator.mediaDevices || (navigator.mediaDevices = {
                    getUserMedia: x,
                    enumerateDevices: function() {
                        return new Promise(function(e) {
                            var t = {
                                audio: "audioinput",
                                video: "videoinput"
                            };
                            return MediaStreamTrack.getSources(function(i) {
                                e(i.map(function(e) {
                                    return {
                                        label: e.label,
                                        kind: t[e.kind],
                                        deviceId: e.id,
                                        groupId: ""
                                    }
                                }))
                            })
                        })
                    }
                }), navigator.mediaDevices.getUserMedia) {
                var L = navigator.mediaDevices.getUserMedia.bind(navigator.mediaDevices);
                navigator.mediaDevices.getUserMedia = function(e) {
                    return O.log("spec:   " + JSON.stringify(e)), e.audio = k(e.audio), e.video = k(e.video), O.log("chrome: " + JSON.stringify(e)), L(e)
                }
            } else navigator.mediaDevices.getUserMedia = function(e) {
                return x(e)
            };
            void 0 === navigator.mediaDevices.addEventListener && (navigator.mediaDevices.addEventListener = function() {
                    O.log("Dummy mediaDevices.addEventListener called.")
                }), void 0 === navigator.mediaDevices.removeEventListener && (navigator.mediaDevices.removeEventListener = function() {
                    O.log("Dummy mediaDevices.removeEventListener called.")
                }), b = function(e, t) {
                    A >= 43 ? T(e, t) : void 0 !== e.src ? e.src = t ? URL.createObjectURL(t) : null : O.log("Error attaching stream to element.")
                },
                function(e, t) {
                    A >= 43 ? T(e, C(t)) : e.src = t.src
                }
        } else navigator.mediaDevices && navigator.userAgent.match(/Edge\/(\d+).(\d+)$/) ? (O.log("This appears to be Edge"), "edge", A = O.extractVersion(navigator.userAgent, /Edge\/(\d+).(\d+)$/, 2), 12) : O.log("Browser does not appear to be WebRTC-capable");
        else O.log("This does not appear to be a browser"), "not a browser";

        function x(e) {
            return new Promise(function(t, i) {
                E(e, t, i)
            })
        }
        var P;
        try {
            Object.defineProperty({}, "version", {
                set: function(e) {
                    A = e
                }
            })
        } catch (e) {}
        R ? P = R : "undefined" != typeof window && (P = window.RTCPeerConnection);
        var V = null,
            F = function() {
                var e = arguments[0];
                if ("function" == typeof e) {
                    var t = Array.prototype.slice.call(arguments, 1);
                    e.apply(null, t)
                }
            },
            B = function(e) {
                return this.audioContext = (V || (V = I()), V), this.sourceNode = e.otWebkitAudioSource || this.audioContext.createMediaStreamSource(e), this.analyser = this.audioContext.createAnalyser(), this.timeDomainData = new Uint8Array(this.analyser.frequencyBinCount), this.sourceNode.connect(this.analyser), this.getAudioLevel = function() {
                    if (this.analyser) {
                        this.analyser.getByteTimeDomainData(this.timeDomainData);
                        for (var e = 0, t = 0; t < this.timeDomainData.length; t++) e = Math.max(e, Math.abs(this.timeDomainData[t] - 128));
                        return e / 128
                    }
                    return le.warning("can't find analyser in audioLevelHelper"), 0
                }, this
            };
        var U = function(e, t, i) {
                try {
                    var n = document.createElement("video");
                    n.setAttribute("autoplay", ""), n.setAttribute("muted", ""), n.setAttribute("playsinline", ""), n.setAttribute("style", "position: absolute; top: 0; left: 0; width:1px; high:1px;"), document.body.appendChild(n), n.addEventListener("playing", function(e) {
                        p() ? n.videoWidth && (t(n.videoWidth, n.videoHeight), document.body.removeChild(n)) : (t(n.videoWidth, n.videoHeight), document.body.removeChild(n))
                    }), T(n, e)
                } catch (e) {
                    i(e)
                }
            },
            W = function(e) {
                return "number" == typeof e && 0 <= e && e <= 4294967295
            },
            j = function(e) {
                for (var t = 0; t < e.length; t++)
                    for (var i in e[t])
                        if ("number" != typeof e[t][i]) throw new Error("Param user[" + t + "] - [" + i + "] is inValid");
                return !0
            },
            H = function(e) {
                var t = encodeURIComponent(e).match(/%[89ABab]/g);
                return e.length + (t ? t.length : 0)
            },
            G = 0,
            z = 0,
            J = function() {
                return G
            },
            K = function() {
                return z
            },
            Y = function(e, t, i, n, o) {
                var r = new XMLHttpRequest;
                if (r.timeout = t.timeout || 5e3, r.open("POST", e, !0), r.setRequestHeader("Content-type", "application/json; charset=utf-8"), o)
                    for (var a in o) "withCredentials" == a ? r.withCredentials = !0 : r.setRequestHeader(a, o[a]);
                r.onload = function(e) {
                    z += H(r.responseText), i && i(r.responseText)
                }, r.onerror = function(t) {
                    n && n(t, e)
                }, r.ontimeout = function(t) {
                    n && n(t, e)
                };
                var s = JSON.stringify(t);
                G += H(s), r.send(s)
            },
            q = function() {
                return "https:" == document.location.protocol
            },
            Q = i(2),
            X = i.n(Q),
            $ = i(0),
            Z = i.n($),
            ee = {
                eventType: null,
                sid: null,
                lts: null,
                success: null,
                cname: null,
                uid: null,
                peer: null,
                cid: null,
                elapse: null,
                extend: null,
                vid: 0
            },
            te = null,
            ie = function() {
                return te || (te = "process-" + h()(), le.info("processId: " + te)), te
            },
            ne = function() {
                var e = {
                    list: {}
                };
                e.url = q() ? "https://".concat("webcollector-1.agora.io", ":6443/events/message") : "http://".concat("webcollector-1.agora.io", ":6080/events/message"), e.urlBackup = q() ? "https://".concat("webcollector-2.agoraio.cn", ":6443/events/message") : "http://".concat("webcollector-2.agoraio.cn", ":6080/events/message"), e.setProxyServer = function(t) {
                    t ? (e.url = q() ? "https://".concat(t, "/rs/?h=").concat("webcollector-1.agora.io", "&p=6443&d=events/message") : "http://".concat(t, "/rs/?h=").concat("webcollector-1.agora.io", "&p=6080&d=events/message"), e.urlBackup = q() ? "https://".concat(t, "/rs/?h=").concat("webcollector-2.agoraio.cn", "&p=6443&d=events/message") : "http://".concat(t, "/rs/?h=").concat("webcollector-2.agoraio.cn", "&p=6080&d=events/message"), le.debug("reportProxyServerURL: ".concat(e.url)), le.debug("reportProxyServerBackupURL: ".concat(e.urlBackup))) : (e.url = q() ? "https://".concat("webcollector-1.agora.io", ":6443/events/message") : "http://".concat("webcollector-1.agora.io", ":6080/events/message"), e.urlBackup = q() ? "https://".concat("webcollector-2.agoraio.cn", ":6443/events/message") : "http://".concat("webcollector-2.agoraio.cn", ":6080/events/message"))
                }, e.sessionInit = function(t, i) {
                    var o = Z()({}, ee);
                    o.startTime = +new Date, o.sid = t, o.cname = i.cname, e.list[t] = o;
                    var r = Z()({}, o);
                    r.eventType = "session_init", r.appid = i.appid, r.browser = navigator.userAgent, r.build = n, r.lts = +new Date, r.elapse = r.lts - r.startTime, r.extend = le.willUploadConsoleLog() ? JSON.stringify({
                        willUploadConsoleLog: !0
                    }) : null, r.mode = i.mode, r.process = ie(), r.success = i.succ, r.version = "2.5.1", delete r.startTime, e.send({
                        type: "io.agora.pb.Wrtc.Session",
                        data: r
                    }), e._flushInvokeReport(t)
                }, e.joinChooseServer = function(t, i, n) {
                    i.uid && (e.list[t].uid = parseInt(i.uid)), i.cid && (e.list[t].cid = parseInt(i.cid));
                    var o = Z()({}, e.list[t]);
                    o.eventType = "join_choose_server";
                    var r = i.lts;
                    o.lts = Date.now(), o.eventElapse = o.lts - r, o.chooseServerAddr = i.csAddr, o.errorCode = i.ec, o.elapse = o.lts - o.startTime, o.success = i.succ, o.chooseServerAddrList = JSON.stringify(i.serverList), delete o.startTime, e.send({
                        type: "io.agora.pb.Wrtc.JoinChooseServer",
                        data: o
                    })
                }, e.joinGateway = function(t, i) {
                    i.vid && (e.list[t].vid = i.vid);
                    var n = Z()({}, e.list[t]),
                        o = i.lts;
                    n.eventType = "join_gateway", n.lts = Date.now(), n.gatewayAddr = i.addr, n.success = i.succ, n.errorCode = i.ec, n.elapse = n.lts - n.startTime, n.eventElapse = n.lts - o, delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.JoinGateway",
                        data: n
                    })
                }, e.publish = function(t, i) {
                    var n = Z()({}, e.list[t]);
                    n.eventType = "publish";
                    var o = i.lts;
                    n.lts = Date.now(), n.eventElapse = n.lts - o, n.elapse = n.lts - n.startTime, n.success = i.succ, n.errorCode = i.ec, i.videoName && (n.videoName = i.videoName), i.audioName && (n.audioName = i.audioName), i.screenName && (n.screenName = i.screenName), delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.Publish",
                        data: n
                    })
                }, e.subscribe = function(t, i) {
                    var n = Z()({}, e.list[t]);
                    n.eventType = "subscribe";
                    var o = i.lts;
                    n.lts = Date.now(), n.eventElapse = n.lts - o, n.elapse = n.lts - n.startTime, n.errorCode = i.ec, n.success = i.succ, "boolean" == typeof i.video && (n.video = i.video), "boolean" == typeof i.audio && (n.audio = i.audio), delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.Subscribe",
                        data: n
                    })
                }, e.firstRemoteFrame = function(t, i) {
                    var n = Z()({}, e.list[t]);
                    n.eventType = "first_remote_frame";
                    var o = i.lts;
                    n.lts = Date.now(), n.eventElapse = n.lts - o, n.elapse = n.lts - n.startTime, n.width = i.width, n.height = i.height, n.success = i.succ, n.errorCode = i.ec, n.peer = parseInt(i.peerid), delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.FirstFrame",
                        data: n
                    })
                }, e.streamSwitch = function(t, i) {
                    var n = Z()({}, e.list[t]);
                    n.eventType = "stream_switch", n.lts = Date.now(), n.isDual = i.isdual, n.elapse = n.lts - n.startTime, n.success = n.succ, delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.StreamSwitch",
                        data: n
                    })
                }, e.audioSendingStopped = function(t, i) {
                    var n = Z()({}, e.list[t]);
                    n.eventType = "audio_sending_stopped", n.lts = Date.now(), n.elapse = n.lts - n.startTime, n.reason = i.reason, n.success = i.succ, delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.AudioSendingStopped",
                        data: n
                    })
                }, e.videoSendingStopped = function(t, i) {
                    var n = Z()({}, e.list[t]);
                    n.eventType = "video_sending_stopped", n.lts = Date.now(), n.elapse = n.lts - n.startTime, n.reson = i.reason, n.success = i.succ, delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.VideoSendingStopped",
                        data: n
                    })
                }, e.requestProxyAppCenter = function(t, i) {
                    var n = Z()({}, e.list[t]),
                        o = i.lts;
                    n.eventType = "request_proxy_appcenter", n.lts = Date.now(), n.eventElapse = n.lts - o, n.elapse = n.lts - n.startTime, n.extend = i.extend + "", n.APAddr = i.APAddr, n.workerManagerList = i.workerManagerList, n.response = i.response, n.errorCode = i.ec, n.success = i.succ, delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.RequestProxyAppCenter",
                        data: n
                    })
                }, e.requestProxyWorkerManager = function(t, i) {
                    var n = Z()({}, e.list[t]),
                        o = i.lts;
                    n.eventType = "request_proxy_worker_manager", n.lts = Date.now(), n.eventElapse = n.lts - o, n.elapse = n.lts - n.startTime, n.extend = i.extend, n.workerManagerAddr = i.workerManagerAddr, n.response = i.response, n.errorCode = i.ec, n.success = i.succ, delete n.startTime, e.send({
                        type: "io.agora.pb.Wrtc.RequestProxyWorkerManager",
                        data: n
                    })
                };
                var t = 0;
                return e.reportApiInvoke = function(e, i) {
                    var n = i.name,
                        o = i.getStates,
                        r = i.options,
                        a = i.timeout,
                        s = void 0 === a ? 6e4 : a,
                        d = i.callback,
                        c = i.reportResult,
                        u = void 0 === c || c,
                        l = Date.now(),
                        p = 0,
                        g = t++,
                        m = function() {
                            return X()({
                                invokeId: g,
                                sid: e,
                                name: n,
                                apiInvokeTime: l,
                                options: r
                            }, o && {
                                states: function(e) {
                                    return Object.keys(e).reduce(function(t, i) {
                                        var n = t;
                                        return null != e[i] && (n[i] = e[i]), n
                                    }, {})
                                }(o())
                            })
                        },
                        f = setTimeout(function() {
                            ne._sendApiInvoke(X()({}, m(), {
                                error: "API_INVOKE_TIMEOUT",
                                success: !1
                            }))
                        }, s);
                    return function(e, t) {
                        if (clearTimeout(f), ++p > 1 && (e = "EXECUTOR_INVOKE_".concat(p)), e) return ne._sendApiInvoke(X()({}, m(), {
                            success: !1,
                            error: e
                        }, o && {
                            states: o()
                        })), d && d(e);
                        ne._sendApiInvoke(X()({}, m(), {
                            success: !0
                        }, u && {
                            result: t
                        }, o && {
                            states: o()
                        })), d && d(null, t)
                    }
                }, e._cachedItems = [], e._cacheInvokeReport = function(t) {
                    t.lts || (t.lts = Date.now()), e._cachedItems.push(t), e._cachedItems.length > 10 && e._cachedItems.shift()
                }, e._flushInvokeReport = function(t) {
                    if (e._cachedItems.length) {
                        var i = e._cachedItems;
                        e._cachedItems = [], le.debug("Flush cached event reporting:", i.length), i.forEach(function(i, n) {
                            i.sid = t, setTimeout(function() {
                                e._sendApiInvoke(i)
                            }, 5e3 + 500 * n)
                        })
                    }
                }, e._sendApiInvoke = function(t) {
                    var i = t.invokeId,
                        n = t.sid,
                        o = t.name,
                        r = t.result,
                        a = t.states,
                        s = t.options,
                        d = t.error,
                        c = t.success,
                        u = t.apiInvokeTime,
                        l = t.lts;
                    if (!e.list[n]) return le.debug("Cached standalone report item for ".concat(o)), void e._cacheInvokeReport(arguments[0]);
                    var p = e.list[n],
                        g = p.startTime,
                        m = p.cname,
                        f = p.uid,
                        v = p.cid,
                        S = (l = l || Date.now()) - g,
                        _ = l - u,
                        h = X()({
                            invokeId: i,
                            sid: n,
                            cname: m,
                            cid: v,
                            lts: l,
                            uid: f,
                            success: c,
                            elapse: S,
                            apiName: o,
                            execElapse: _
                        }, void 0 !== s && {
                            options: JSON.stringify(s)
                        }, void 0 !== a && {
                            execStates: JSON.stringify(a)
                        }, void 0 !== d && {
                            errorCode: d
                        }, void 0 !== r && {
                            execResult: JSON.stringify(r)
                        });
                    e.send({
                        type: "io.agora.pb.Wrtc.ApiInvoke",
                        data: h
                    })
                }, e.send = function(t) {
                    try {
                        Y(e.url, t, null, function(i) {
                            Y(e.urlBackup, t, null, function(e) {}, {
                                timeout: 1e4
                            })
                        }, {
                            timeout: 1e4
                        })
                    } catch (e) {}
                }, e
            }(),
            oe = 0,
            re = "free",
            ae = [],
            se = [],
            de = 0,
            ce = !1;
        setInterval(function() {
            ce && ue.info("console log upload")
        }, 9e5);
        var ue = function() {
                var e, t, i = "https://logservice.agora.io/upload/v1",
                    n = ["DEBUG", "INFO", "WARNING", "ERROR", "NONE"],
                    o = 0,
                    r = function e(t) {
                        re = "uploading", setTimeout(function() {
                            ! function(e, t, n) {
                                var o;
                                Array.isArray(e) || (e = [e]), e = e.map(function(e) {
                                    return {
                                        log_item_id: oe++,
                                        log_level: e.log_level,
                                        payload_str: e.payload
                                    }
                                }), o = {
                                    sdk_version: "2.5.1",
                                    process_id: ie(),
                                    payload: JSON.stringify(e)
                                };
                                try {
                                    Y(i, o, function(e) {
                                        "OK" === e ? t && t(e) : n && n(e)
                                    }, function(e) {
                                        n && n(e)
                                    }, {
                                        withCredentials: !0
                                    })
                                } catch (e) {
                                    n && n(e)
                                }
                            }(t, function() {
                                de = 0, 0 !== ae.length ? (se = ae.length < 10 ? ae.splice(0, ae.length) : ae.splice(0, 10), e(se)) : re = "free"
                            }, function() {
                                setTimeout(function() {
                                    e(se)
                                }, de++ < 2 ? 200 : 1e4)
                            })
                        }, 3e3)
                    },
                    a = {};
                return {
                    DEBUG: 0,
                    INFO: 1,
                    WARNING: 2,
                    ERROR: 3,
                    NONE: 4,
                    enableLogUpload: function() {
                        ce = !0
                    },
                    disableLogUpload: function() {
                        ce = !1
                    },
                    setProxyServer: function(e) {
                        i = e ? "https://".concat(e, "/ls/?h=").concat("logservice.agora.io", "&p=443&d=upload/v1") : "https://logservice.agora.io/upload/v1"
                    },
                    setLogLevel: function(e) {
                        e > 4 ? e = 4 : e < 0 && (e = 0), o = e
                    },
                    log: e = function() {
                        var e = arguments[0],
                            t = arguments;
                        if (t[0] = function() {
                                var e = new Date;
                                return e.toTimeString().split(" ")[0] + ":" + e.getMilliseconds()
                            }() + " Agora-SDK [" + (n[e] || "DEFAULT") + "]:", function(e, t) {
                                if (ce) try {
                                    t = Array.prototype.slice.call(t);
                                    var i = "";
                                    t.forEach(function(e) {
                                        "object" === c()(e) && (e = JSON.stringify(e)), i = i + e + " "
                                    }), ae.push({
                                        payload: i,
                                        log_level: e
                                    }), "free" === re && (se = ae.length < 10 ? ae.splice(0, ae.length) : ae.splice(0, 10), r(se))
                                } catch (e) {}
                            }(e, t), !(e < o)) switch (e) {
                            case 0:
                            case 1:
                                console.log.apply(console, t);
                                break;
                            case 2:
                                console.warn.apply(console, t);
                                break;
                            case 3:
                                console.error.apply(console, t);
                                break;
                            default:
                                return void console.log.apply(console, t)
                        }
                    },
                    debug: function() {
                        for (var t = [0], i = 0; i < arguments.length; i++) t.push(arguments[i]);
                        e.apply(this, t)
                    },
                    info: function() {
                        for (var t = [1], i = 0; i < arguments.length; i++) t.push(arguments[i]);
                        e.apply(this, t)
                    },
                    warning: t = function() {
                        for (var t = [2], i = 0; i < arguments.length; i++) t.push(arguments[i]);
                        e.apply(this, t)
                    },
                    deprecate: function(e) {
                        a[e] || (t.apply(void 0, arguments), a[e] = !0)
                    },
                    error: function() {
                        for (var t = [3], i = 0; i < arguments.length; i++) t.push(arguments[i]);
                        e.apply(this, t)
                    },
                    willUploadConsoleLog: function() {
                        return ce
                    }
                }
            }(),
            le = ue,
            pe = function() {
                var e = {
                    dispatcher: {}
                };
                return e.dispatcher.eventListeners = {}, e.addEventListener = function(t, i) {
                    void 0 === e.dispatcher.eventListeners[t] && (e.dispatcher.eventListeners[t] = []), e.dispatcher.eventListeners[t].push(i)
                }, e.hasListeners = function(t) {
                    return !(!e.dispatcher.eventListeners[t] || !e.dispatcher.eventListeners[t].length)
                }, e.on = e.addEventListener, e.removeEventListener = function(t, i) {
                    var n; - 1 !== (n = e.dispatcher.eventListeners[t].indexOf(i)) && e.dispatcher.eventListeners[t].splice(n, 1)
                }, e.dispatchEvent = function(t) {
                    var i;
                    for (i in e.dispatcher.eventListeners[t.type]) e.dispatcher.eventListeners[t.type] && e.dispatcher.eventListeners[t.type].hasOwnProperty(i) && "function" == typeof e.dispatcher.eventListeners[t.type][i] && e.dispatcher.eventListeners[t.type][i](t)
                }, e.dispatchSocketEvent = function(t) {
                    var i;
                    for (i in e.dispatcher.eventListeners[t.type]) e.dispatcher.eventListeners[t.type] && e.dispatcher.eventListeners[t.type].hasOwnProperty(i) && "function" == typeof e.dispatcher.eventListeners[t.type][i] && e.dispatcher.eventListeners[t.type][i](t.msg)
                }, e
            },
            ge = function(e) {
                var t = {};
                return t.type = e.type, t
            },
            me = function(e) {
                var t = ge(e);
                return t.stream = e.stream, t.reason = e.reason, t.msg = e.msg, t
            },
            fe = function(e) {
                var t = ge(e);
                return t.uid = e.uid, t.attr = e.attr, t.stream = e.stream, t
            },
            ve = function(e) {
                var t = ge(e);
                return t.msg = e.msg, t
            },
            Se = function(e) {
                var t = ge(e);
                return t.url = e.url, t.uid = e.uid, t.status = e.status, t.reason = e.reason, t
            },
            _e = function(e) {
                var t = pe();
                return t.url = ".", t
            },
            he = {
                101100: "NO_FLAG_SET",
                101101: "FLAG_SET_BUT_EMPTY",
                101102: "INVALID_FALG_SET",
                101203: "NO_SERVICE_AVIABLE",
                0: "OK_CODE",
                5: "INVALID_VENDOR_KEY",
                7: "INVALID_CHANNEL_NAME",
                8: "INTERNAL_ERROR",
                9: "NO_AUTHORIZED",
                10: "DYNAMIC_KEY_TIMEOUT",
                11: "NO_ACTIVE_STATUS",
                13: "DYNAMIC_KEY_EXPIRED",
                14: "STATIC_USE_DYANMIC_KEY",
                15: "DYNAMIC_USE_STATIC_KEY"
            },
            ye = {
                2000: "ERR_NO_VOCS_AVAILABLE",
                2001: "ERR_NO_VOS_AVAILABLE",
                2002: "ERR_JOIN_CHANNEL_TIMEOUT",
                2003: "WARN_REPEAT_JOIN",
                2004: "ERR_JOIN_BY_MULTI_IP",
                101: "ERR_INVALID_VENDOR_KEY",
                102: "ERR_INVALID_CHANNEL_NAME",
                103: "WARN_NO_AVAILABLE_CHANNEL",
                104: "WARN_LOOKUP_CHANNEL_TIMEOUT",
                105: "WARN_LOOKUP_CHANNEL_REJECTED",
                106: "WARN_OPEN_CHANNEL_TIMEOUT",
                107: "WARN_OPEN_CHANNEL_REJECTED",
                108: "WARN_REQUEST_DEFERRED",
                109: "ERR_DYNAMIC_KEY_TIMEOUT",
                110: "ERR_NO_AUTHORIZED",
                111: "ERR_VOM_SERVICE_UNAVAILABLE",
                112: "ERR_NO_CHANNEL_AVAILABLE_CODE",
                113: "ERR_TOO_MANY_USERS",
                114: "ERR_MASTER_VOCS_UNAVAILABLE",
                115: "ERR_INTERNAL_ERROR",
                116: "ERR_NO_ACTIVE_STATUS",
                117: "ERR_INVALID_UID",
                118: "ERR_DYNAMIC_KEY_EXPIRED",
                119: "ERR_STATIC_USE_DYANMIC_KE",
                120: "ERR_DYNAMIC_USE_STATIC_KE",
                2: "K_TIMESTAMP_EXPIRED",
                3: "K_CHANNEL_PERMISSION_INVALID",
                4: "K_CERTIFICATE_INVALID",
                5: "K_CHANNEL_NAME_EMPTY",
                6: "K_CHANNEL_NOT_FOUND",
                7: "K_TICKET_INVALID",
                8: "K_CHANNEL_CONFLICTED",
                9: "K_SERVICE_NOT_READY",
                10: "K_SERVICE_TOO_HEAVY",
                14: "K_UID_BANNED",
                15: "K_IP_BANNED",
                16: "K_CHANNEL_BANNED"
            },
            Ie = ["NO_SERVICE_AVIABLE"],
            Ee = {
                19: "ERR_ALREADY_IN_USE",
                10: "ERR_TIMEDOUT",
                3: "ERR_NOT_READY",
                9: "ERR_NO_PERMISSION",
                0: "UNKNOW_ERROR"
            },
            be = {
                FAILED: "FAILED",
                INVALID_KEY: "INVALID_KEY",
                INVALID_CLIENT_MODE: "INVALID_CLIENT_MODE",
                INVALID_CLIENT_CODEC: "INVALID_CLIENT_CODEC",
                CLIENT_MODE_CODEC_MISMATCH: "CLIENT_MODE_CODEC_MISMATCH",
                WEB_API_NOT_SUPPORTED: "WEB_API_NOT_SUPPORTED",
                INVALID_PARAMETER: "INVALID_PARAMETER",
                INVALID_OPERATION: "INVALID_OPERATION",
                INVALID_LOCAL_STREAM: "INVALID_LOCAL_STREAM",
                INVALID_REMOTE_STREAM: "INVALID_REMOTE_STREAM",
                INVALID_DYNAMIC_KEY: "INVALID_DYNAMIC_KEY",
                DYNAMIC_KEY_TIMEOUT: "DYNAMIC_KEY_TIMEOUT",
                NO_VOCS_AVAILABLE: "NO_VOCS_AVAILABLE",
                NO_VOS_AVAILABLE: "ERR_NO_VOS_AVAILABLE",
                JOIN_CHANNEL_TIMEOUT: "ERR_JOIN_CHANNEL_TIMEOUT",
                NO_AVAILABLE_CHANNEL: "NO_AVAILABLE_CHANNEL",
                LOOKUP_CHANNEL_TIMEOUT: "LOOKUP_CHANNEL_TIMEOUT",
                LOOKUP_CHANNEL_REJECTED: "LOOKUP_CHANNEL_REJECTED",
                OPEN_CHANNEL_TIMEOUT: "OPEN_CHANNEL_TIMEOUT",
                OPEN_CHANNEL_REJECTED: "OPEN_CHANNEL_REJECTED",
                REQUEST_DEFERRED: "REQUEST_DEFERRED",
                STREAM_ALREADY_PUBLISHED: "STREAM_ALREADY_PUBLISHED",
                STREAM_NOT_YET_PUBLISHED: "STREAM_NOT_YET_PUBLISHED",
                JOIN_TOO_FREQUENT: "JOIN_TOO_FREQUENT",
                SOCKET_ERROR: "SOCKET_ERROR",
                SOCKET_DISCONNECTED: "SOCKET_DISCONNECTED",
                PEERCONNECTION_FAILED: "PEERCONNECTION_FAILED",
                CONNECT_GATEWAY_ERROR: "CONNECT_GATEWAY_ERROR",
                SERVICE_NOT_AVAILABLE: "SERVICE_NOT_AVAILABLE",
                JOIN_CHANNEL_FAILED: "JOIN_CHANNEL_FAILED",
                PUBLISH_STREAM_FAILED: "PUBLISH_STREAM_FAILED",
                UNPUBLISH_STREAM_FAILED: "UNPUBLISH_STREAM_FAILED",
                SUBSCRIBE_STREAM_FAILED: "SUBSCRIBE_STREAM_FAILED",
                UNSUBSCRIBE_STREAM_FAILED: "UNSUBSCRIBE_STREAM_FAILED",
                NO_SUCH_REMOTE_STREAM: "NO_SUCH_REMOTE_STREAM",
                ERR_FAILED: "1",
                ERR_INVALID_VENDOR_KEY: "101",
                ERR_INVALID_CHANNEL_NAME: "102",
                WARN_NO_AVAILABLE_CHANNEL: "103",
                WARN_LOOKUP_CHANNEL_TIMEOUT: "104",
                WARN_LOOKUP_CHANNEL_REJECTED: "105",
                WARN_OPEN_CHANNEL_TIMEOUT: "106",
                WARN_OPEN_CHANNEL_REJECTED: "107",
                WARN_REQUEST_DEFERRED: "108",
                ERR_DYNAMIC_KEY_TIMEOUT: "109",
                ERR_INVALID_DYNAMIC_KEY: "110",
                ERR_NO_VOCS_AVAILABLE: "2000",
                ERR_NO_VOS_AVAILABLE: "2001",
                ERR_JOIN_CHANNEL_TIMEOUT: "2002",
                IOS_NOT_SUPPORT: "IOS_NOT_SUPPORT",
                WECHAT_NOT_SUPPORT: "WECHAT_NOT_SUPPORT",
                SHARING_SCREEN_NOT_SUPPORT: "SHARING_SCREEN_NOT_SUPPORT",
                STILL_ON_PUBLISHING: "STILL_ON_PUBLISHING",
                LOW_STREAM_ALREADY_PUBLISHED: "LOW_STREAM_ALREADY_PUBLISHED",
                LOW_STREAM_NOT_YET_PUBLISHED: "LOW_STREAM_ALREADY_PUBLISHED",
                HIGH_STREAM_NOT_VIDEO_TRACE: "HIGH_STREAM_NOT_VIDEO_TRACE",
                NOT_FIND_DEVICE_BY_LABEL: "NOT_FIND_DEVICE_BY_LABEL",
                ENABLE_DUALSTREAM_FAILED: "ENABLE_DUALSTREAM_FAILED",
                DISABLE_DUALSTREAM_FAILED: "DISABLE_DUALSTREAM_FAILED",
                PLAYER_NOT_FOUND: "PLAYER_NOT_FOUND",
                ELECTRON_NOT_SUPPORT_SHARING_SCREEN: "ELECTRON_NOT_SUPPORT_SHARING_SCREEN",
                BAD_ENVIRONMENT: "BAD_ENVIRONMENT"
            },
            Ae = function(e) {
                var t = _e({});
                t.id = e.id, t.fit = e.options && e.options.fit, "contain" !== t.fit && "cover" !== t.fit && (t.fit = null), t.url = e.url, t.stream = e.stream.stream, t.elementID = e.elementID, t.setAudioOutput = function(e, i, n) {
                    var o = t.video || t.audio;
                    return o ? o.setSinkId ? void o.setSinkId(e).then(function() {
                        return le.debug("video ".concat(t.id, " setAudioOutput ").concat(e, " SUCCESS")), o == t.video && t.audio ? t.audio.setSinkId(e) : Promise.resolve()
                    }).then(function() {
                        return le.debug("audio ".concat(t.id, " setAudioOutput ").concat(e, " SUCCESS")), i && i()
                    }).catch(function(e) {
                        return le.error("VideoPlayer.setAudioOutput", e), n && n(e)
                    }) : (le.error(be.WEB_API_NOT_SUPPORTED), n && n(be.WEB_API_NOT_SUPPORTED)) : (le.error(be.PLAYER_NOT_FOUND), n && n(be.PLAYER_NOT_FOUND))
                }, t.destroy = function() {
                    T(t.video, null), T(t.audio, null), t.video.pause(), delete t.resizer, document.getElementById(t.div.id) && t.parentNode.contains(t.div) && t.parentNode.removeChild(t.div)
                }, t.div = document.createElement("div"), t.div.setAttribute("id", "player_" + t.id), e.stream.video ? t.div.setAttribute("style", "width: 100%; height: 100%; position: relative; background-color: black; overflow: hidden;") : t.div.setAttribute("style", "width: 100%; height: 100%; position: relative; overflow: hidden;"), t.video = document.createElement("video"), t.video.setAttribute("id", "video" + t.id), e.stream.local && !e.stream.screen ? e.stream.mirror ? t.video.setAttribute("style", "width: 100%; height: 100%; position: absolute; transform: rotateY(180deg); object-fit: ".concat(t.fit || "cover", ";")) : t.video.setAttribute("style", "width: 100%; height: 100%; position: absolute; object-fit: ".concat(t.fit || "cover", ";")) : e.stream.video ? t.video.setAttribute("style", "width: 100%; height: 100%; position: absolute; object-fit: ".concat(t.fit || "cover", ";")) : e.stream.screen ? t.video.setAttribute("style", "width: 100%; height: 100%; position: absolute; object-fit: ".concat(t.fit || "contain")) : t.video.setAttribute("style", "width: 100%; height: 100%; position: absolute; display: none; object-fit: ".concat(t.fit || "cover"));
                var i = {
                        autoplay: !0,
                        muted: !!e.stream.local,
                        playsinline: !0,
                        controls: !(!l() || e.stream.local),
                        volume: null
                    },
                    n = Z()({}, i, e.options);
                if (n.muted && !n.volume && (n.volume = 0), n.autoplay && t.video.setAttribute("autoplay", ""), n.muted && t.video.setAttribute("muted", ""), n.muted && (t.video.muted = !0), n.playsinline && t.video.setAttribute("playsinline", ""), n.controls && t.video.setAttribute("controls", ""), Number.isFinite(n.volume) && (t.video.volume = n.volume), t.audio = document.createElement("audio"), t.audio.setAttribute("id", "audio" + t.id), n.autoplay && t.audio.setAttribute("autoplay", ""), n.muted && t.audio.setAttribute("muted", ""), n.muted && (t.audio.muted = !0), n.playsinline && t.audio.setAttribute("playsinline", ""), Number.isFinite(n.volume) && (t.audio.volume = n.volume), void 0 !== t.elementID ? (document.getElementById(t.elementID).appendChild(t.div), t.container = document.getElementById(t.elementID)) : (document.body.appendChild(t.div), t.container = document.body), t.parentNode = t.div.parentNode, t.video.addEventListener("playing", function(e) {
                        ! function e() {
                            t.video.videoWidth * t.video.videoHeight > 4 ? le.debug("video dimensions:", t.video.videoWidth, t.video.videoHeight) : setTimeout(e, 50)
                        }()
                    }), e.stream.hasVideo() || e.stream.hasScreen()) t.div.appendChild(t.video), t.div.appendChild(t.audio), b(t.video, e.stream.stream), b(t.audio, e.stream.stream);
                else if (!e.stream.local && t.video.removeAttribute("muted"), t.div.appendChild(t.video), window.MediaStream && l()) {
                    var o = new MediaStream(e.stream.stream.getAudioTracks());
                    T(t.video, o)
                } else T(t.video, e.stream.stream);
                return t.setAudioVolume = function(e) {
                    var i = parseInt(e) / 100;
                    isFinite(i) && (i < 0 ? i = 0 : i > 1 && (i = 1), t.video && (t.video.volume = i), t.audio && (t.audio.volume = i))
                }, t
            },
            Re = function(e) {
                var t = {},
                    i = webkitRTCPeerConnection;
                t.pc_config = {
                    iceServers: []
                }, t.con = {
                    optional: [{
                        DtlsSrtpKeyAgreement: !0
                    }]
                }, e.iceServers instanceof Array ? t.pc_config.iceServers = e.iceServers : (e.stunServerUrl && (e.stunServerUrl instanceof Array ? e.stunServerUrl.map(function(e) {
                    "string" == typeof e && "" !== e && t.pc_config.iceServers.push({
                        url: e
                    })
                }) : "string" == typeof e.stunServerUrl && "" !== e.stunServerUrl && t.pc_config.iceServers.push({
                    url: e.stunServerUrl
                })), e.turnServer && (e.turnServer instanceof Array ? e.turnServer.map(function(e) {
                    "string" == typeof e.url && "" !== e.url && t.pc_config.iceServers.push({
                        username: e.username,
                        credential: e.password,
                        url: e.url
                    })
                }) : "string" == typeof e.turnServer.url && "" !== e.turnServer.url && t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.password,
                    url: e.turnServer.url
                }))), void 0 === e.audio && (e.audio = !0), void 0 === e.video && (e.video = !0), t.mediaConstraints = {
                    mandatory: {
                        OfferToReceiveVideo: e.video,
                        OfferToReceiveAudio: e.audio
                    }
                }, t.roapSessionId = 103, t.peerConnection = new i(t.pc_config, t.con), t.peerConnection.onicecandidate = function(e) {
                    e.candidate ? t.iceCandidateCount += 1 : (le.debug("PeerConnection State: " + t.peerConnection.iceGatheringState), void 0 === t.ices && (t.ices = 0), t.ices = t.ices + 1, t.ices >= 1 && t.moreIceComing && (t.moreIceComing = !1, t.markActionNeeded()))
                };
                var n = function(t) {
                    var i, n;
                    return e.minVideoBW && e.maxVideoBW && (n = (i = t.match(/m=video.*\r\n/))[0] + "b=AS:" + e.maxVideoBW + "\r\n", t = t.replace(i[0], n), le.debug("Set Video Bitrate - min:" + e.minVideoBW + " max:" + e.maxVideoBW)), e.maxAudioBW && (n = (i = t.match(/m=audio.*\r\n/))[0] + "b=AS:" + e.maxAudioBW + "\r\n", t = t.replace(i[0], n)), t
                };
                return t.processSignalingMessage = function(e) {
                    var i, o = JSON.parse(e);
                    t.incomingMessage = o, "new" === t.state ? "OFFER" === o.messageType ? (i = {
                        sdp: o.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(i)), t.state = "offer-received", t.markActionNeeded()) : t.error("Illegal message for this state: " + o.messageType + " in state " + t.state) : "offer-sent" === t.state ? "ANSWER" === o.messageType ? ((i = {
                        sdp: o.sdp,
                        type: "answer"
                    }).sdp = n(i.sdp), t.peerConnection.setRemoteDescription(new RTCSessionDescription(i)), t.sendOK(), t.state = "established") : "pr-answer" === o.messageType ? (i = {
                        sdp: o.sdp,
                        type: "pr-answer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(i))) : "offer" === o.messageType ? t.error("Not written yet") : t.error("Illegal message for this state: " + o.messageType + " in state " + t.state) : "established" === t.state && ("OFFER" === o.messageType ? (i = {
                        sdp: o.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(i)), t.state = "offer-received", t.markActionNeeded()) : t.error("Illegal message for this state: " + o.messageType + " in state " + t.state))
                }, t.addStream = function(e) {
                    t.peerConnection.addStream(e), t.markActionNeeded()
                }, t.removeStream = function() {
                    t.markActionNeeded()
                }, t.close = function() {
                    t.state = "closed", t.peerConnection.close()
                }, t.markActionNeeded = function() {
                    t.actionNeeded = !0, t.doLater(function() {
                        t.onstablestate()
                    })
                }, t.doLater = function(e) {
                    window.setTimeout(e, 1)
                }, t.onstablestate = function() {
                    var e;
                    if (t.actionNeeded) {
                        if ("new" === t.state || "established" === t.state) t.peerConnection.createOffer(function(e) {
                            if (e.sdp = n(e.sdp), le.debug("Changed", e.sdp), e.sdp !== t.prevOffer) return t.peerConnection.setLocalDescription(e), t.state = "preparing-offer", void t.markActionNeeded();
                            le.debug("Not sending a new offer")
                        }, function(e) {
                            le.debug("peer connection create offer failed ", e)
                        }, t.mediaConstraints);
                        else if ("preparing-offer" === t.state) {
                            if (t.moreIceComing) return;
                            t.prevOffer = t.peerConnection.localDescription.sdp, t.sendMessage("OFFER", t.prevOffer), t.state = "offer-sent"
                        } else if ("offer-received" === t.state) t.peerConnection.createAnswer(function(e) {
                            if (t.peerConnection.setLocalDescription(e), t.state = "offer-received-preparing-answer", t.iceStarted) t.markActionNeeded();
                            else {
                                var i = new Date;
                                le.debug(i.getTime() + ": Starting ICE in responder"), t.iceStarted = !0
                            }
                        }, function(e) {
                            le.debug("peer connection create answer failed ", e)
                        }, t.mediaConstraints);
                        else if ("offer-received-preparing-answer" === t.state) {
                            if (t.moreIceComing) return;
                            e = t.peerConnection.localDescription.sdp, t.sendMessage("ANSWER", e), t.state = "established"
                        } else t.error("Dazed and confused in state " + t.state + ", stopping here");
                        t.actionNeeded = !1
                    }
                }, t.sendOK = function() {
                    t.sendMessage("OK")
                }, t.sendMessage = function(e, i) {
                    var n = {};
                    n.messageType = e, n.sdp = i, "OFFER" === e ? (n.offererSessionId = t.sessionId, n.answererSessionId = t.otherSessionId, n.seq = t.sequenceNumber += 1, n.tiebreaker = Math.floor(429496723 * Math.random() + 1)) : (n.offererSessionId = t.incomingMessage.offererSessionId, n.answererSessionId = t.sessionId, n.seq = t.incomingMessage.seq), t.onsignalingmessage(JSON.stringify(n))
                }, t._getSender = function(e) {
                    if (t.peerConnection && t.peerConnection.getSenders) {
                        var i = t.peerConnection.getSenders().find(function(t) {
                            return t.track.kind == e
                        });
                        if (i) return i
                    }
                    return null
                }, t.hasSender = function(e) {
                    return !!t._getSender(e)
                }, t.replaceTrack = function(e, i, n) {
                    var o = t._getSender(e.kind);
                    if (!o) return n("NO_SENDER_FOUND");
                    try {
                        o.replaceTrack(e)
                    } catch (e) {
                        return n && n(e)
                    }
                    setTimeout(function() {
                        return i && i()
                    }, 50)
                }, t.error = function(e) {
                    throw "Error in RoapOnJsep: " + e
                }, t.sessionId = t.roapSessionId += 1, t.sequenceNumber = 0, t.actionNeeded = !1, t.iceStarted = !1, t.moreIceComing = !0, t.iceCandidateCount = 0, t.onsignalingmessage = e.callback, t.peerConnection.onopen = function() {
                    t.onopen && t.onopen()
                }, t.peerConnection.onaddstream = function(e) {
                    t.onaddstream && t.onaddstream(e)
                }, t.peerConnection.onremovestream = function(e) {
                    t.onremovestream && t.onremovestream(e)
                }, t.peerConnection.oniceconnectionstatechange = function(e) {
                    t.oniceconnectionstatechange && t.oniceconnectionstatechange(e.currentTarget.iceConnectionState)
                }, t.onaddstream = null, t.onremovestream = null, t.state = "new", t.markActionNeeded(), t
            },
            Te = function(e) {
                var t = {},
                    i = P;
                t.uid = e.uid, t.isVideoMute = e.isVideoMute, t.isAudioMute = e.isAudioMute, t.isSubscriber = e.isSubscriber, t.pc_config = {
                    iceServers: [{
                        url: "stun:webcs.agora.io:3478"
                    }]
                }, t.con = {
                    optional: [{
                        DtlsSrtpKeyAgreement: !0
                    }]
                }, e.iceServers instanceof Array ? t.pc_config.iceServers = e.iceServers : (e.stunServerUrl && (e.stunServerUrl instanceof Array ? e.stunServerUrl.map(function(e) {
                    "string" == typeof e && "" !== e && t.pc_config.iceServers.push({
                        url: e
                    })
                }) : "string" == typeof e.stunServerUrl && "" !== e.stunServerUrl && t.pc_config.iceServers.push({
                    url: e.stunServerUrl
                })), e.turnServer && (e.turnServer instanceof Array ? e.turnServer.map(function(e) {
                    "string" == typeof e.url && "" !== e.url && t.pc_config.iceServers.push({
                        username: e.username,
                        credential: e.password,
                        url: e.url
                    })
                }) : "string" == typeof e.turnServer.url && "" !== e.turnServer.url && (t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.credential,
                    credentialType: "password",
                    urls: "turn:" + e.turnServer.url + ":" + e.turnServer.udpport + "?transport=udp"
                }), "string" == typeof e.turnServer.tcpport && "" !== e.turnServer.tcpport && t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.credential,
                    credentialType: "password",
                    urls: "turn:" + e.turnServer.url + ":" + e.turnServer.tcpport + "?transport=tcp"
                }), !0 === e.turnServer.forceturn && (t.pc_config.iceTransportPolicy = "relay")))), void 0 === e.audio && (e.audio = !0), void 0 === e.video && (e.video = !0), t.mediaConstraints = {
                    mandatory: {
                        OfferToReceiveVideo: e.video,
                        OfferToReceiveAudio: e.audio
                    }
                }, t.roapSessionId = 103, t.peerConnection = new i(t.pc_config, t.con), t.peerConnection.onicecandidate = function(e) {
                    var i, n, o, r;
                    n = (i = t.peerConnection.localDescription.sdp).match(/a=candidate:.+typ\ssrflx.+\r\n/), o = i.match(/a=candidate:.+typ\shost.+\r\n/), r = i.match(/a=candidate:.+typ\srelay.+\r\n/), 0 === t.iceCandidateCount && (t.timeout = setTimeout(function() {
                        t.moreIceComing && (t.moreIceComing = !1, t.markActionNeeded())
                    }, 1e3)), null === n && null === o && null === r || void 0 !== t.ice || (le.debug("srflx candidate : " + n + " relay candidate: " + r + " host candidate : " + o), clearTimeout(t.timeout), t.ice = 0, t.moreIceComing = !1, t.markActionNeeded()), t.iceCandidateCount = t.iceCandidateCount + 1
                }, le.debug('Created webkitRTCPeerConnnection with config "' + JSON.stringify(t.pc_config) + '".');
                var n = function(t) {
                        return e.screen && (t = t.replace("a=x-google-flag:conference\r\n", "")), t
                    },
                    o = function(t) {
                        var i, n;
                        if (e.minVideoBW && e.maxVideoBW) {
                            n = (i = t.match(/m=video.*\r\n/))[0] + "b=AS:" + e.maxVideoBW + "\r\n";
                            var o = 0,
                                r = 0;
                            "h264" === e.codec ? (o = t.search(/a=rtpmap:(\d+) H264\/90000\r\n/), r = t.search(/H264\/90000\r\n/)) : "vp8" === e.codec && (o = t.search(/a=rtpmap:(\d+) VP8\/90000\r\n/), r = t.search(/VP8\/90000\r\n/)), -1 !== o && -1 !== r && r - o > 10 && (n = n + "a=fmtp:" + t.slice(o + 9, r - 1) + " x-google-min-bitrate=" + e.minVideoBW + "\r\n"), t = t.replace(i[0], n), le.debug("Set Video Bitrate - min:" + e.minVideoBW + " max:" + e.maxVideoBW)
                        }
                        return e.maxAudioBW && (n = (i = t.match(/m=audio.*\r\n/))[0] + "b=AS:" + e.maxAudioBW + "\r\n", t = t.replace(i[0], n)), t
                    };
                return t.processSignalingMessage = function(e) {
                    var i, r = JSON.parse(e);
                    t.incomingMessage = r, "new" === t.state ? "OFFER" === r.messageType ? (i = {
                        sdp: r.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(i)), t.state = "offer-received", t.markActionNeeded()) : t.error("Illegal message for this state: " + r.messageType + " in state " + t.state) : "offer-sent" === t.state ? "ANSWER" === r.messageType ? ((i = {
                        sdp: r.sdp,
                        type: "answer"
                    }).sdp = n(i.sdp), i.sdp = o(i.sdp), t.peerConnection.setRemoteDescription(new RTCSessionDescription(i)), t.sendOK(), t.state = "established") : "pr-answer" === r.messageType ? (i = {
                        sdp: r.sdp,
                        type: "pr-answer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(i))) : "offer" === r.messageType ? t.error("Not written yet") : t.error("Illegal message for this state: " + r.messageType + " in state " + t.state) : "established" === t.state && ("OFFER" === r.messageType ? (i = {
                        sdp: r.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(i)), t.state = "offer-received", t.markActionNeeded()) : "ANSWER" === r.messageType ? ((i = {
                        sdp: r.sdp,
                        type: "answer"
                    }).sdp = n(i.sdp), i.sdp = o(i.sdp), t.peerConnection.setRemoteDescription(new RTCSessionDescription(i))) : t.error("Illegal message for this state: " + r.messageType + " in state " + t.state))
                }, t.getVideoRelatedStats = function(e) {
                    t.peerConnection.getStats(null, function(i) {
                        Object.keys(i).forEach(function(n) {
                            var o = i[n];
                            t.isSubscriber ? "video" === o.mediaType && o.id && ~o.id.indexOf("recv") && e && e({
                                mediaType: "video",
                                peerId: t.uid,
                                isVideoMute: t.isVideoMute,
                                frameRateReceived: o.googFrameRateReceived,
                                frameRateDecoded: o.googFrameRateDecoded
                            }) : "video" === o.mediaType && o.id && ~o.id.indexOf("send") && e && e({
                                mediaType: "video",
                                isVideoMute: t.isVideoMute,
                                frameRateInput: o.googFrameRateInput,
                                frameRateSent: o.googFrameRateSent,
                                googRtt: o.googRtt
                            })
                        })
                    })
                }, t.getAudioRelatedStats = function(e) {
                    t.peerConnection.getStats(null, function(i) {
                        Object.keys(i).forEach(function(n) {
                            var o = i[n];
                            t.isSubscriber && "audio" === o.mediaType && o.id && ~o.id.indexOf("recv") && e && e({
                                mediaType: "audio",
                                peerId: t.uid,
                                isAudioMute: t.isAudioMute,
                                frameDropped: parseInt(o.googDecodingPLC) + parseInt(o.googDecodingPLCCNG) + "",
                                frameReceived: o.googDecodingCTN
                            })
                        })
                    })
                }, t.getStatsRate = function(e) {
                    t.getStats(function(t) {
                        e(t)
                    })
                }, t.getStats = function(e) {
                    t.peerConnection.getStats(null, function(i) {
                        var n = [],
                            o = [],
                            r = null;
                        Object.keys(i).forEach(function(e) {
                            var t = i[e];
                            o.push(t), "ssrc" !== t.type && "VideoBwe" !== t.type || (r = t.timestamp, n.push(t))
                        }), n.push({
                            id: "time",
                            startTime: t.connectedTime,
                            timestamp: r || new Date
                        }), e(n, o)
                    })
                }, t.addTrack = function(e, i) {
                    t.peerConnection.addTrack(e, i)
                }, t.removeTrack = function(e, i) {
                    t.peerConnection.removeTrack(t.peerConnection.getSenders().find(function(t) {
                        return t.track == e
                    }))
                }, t.addStream = function(e) {
                    t.peerConnection.addStream(e), t.markActionNeeded()
                }, t.removeStream = function() {
                    t.markActionNeeded()
                }, t.close = function() {
                    t.state = "closed", t.peerConnection.close()
                }, t.markActionNeeded = function() {
                    t.actionNeeded = !0, t.doLater(function() {
                        t.onstablestate()
                    })
                }, t.doLater = function(e) {
                    window.setTimeout(e, 1)
                }, t.onstablestate = function() {
                    var e;
                    if (t.actionNeeded) {
                        if ("new" === t.state || "established" === t.state) t.peerConnection.createOffer(function(e) {
                            if (e.sdp !== t.prevOffer) return t.peerConnection.setLocalDescription(e), t.state = "preparing-offer", void t.markActionNeeded();
                            le.debug("Not sending a new offer")
                        }, function(e) {
                            le.debug("peer connection create offer failed ", e)
                        }, t.mediaConstraints);
                        else if ("preparing-offer" === t.state) {
                            if (t.moreIceComing) return;
                            t.prevOffer = t.peerConnection.localDescription.sdp, t.prevOffer = t.prevOffer.replace(/a=candidate:.+typ\shost.+\r\n/g, "a=candidate:2243255435 1 udp 2122194687 192.168.0.1 30000 typ host generation 0 network-id 1\r\n"), t.sendMessage("OFFER", t.prevOffer), t.state = "offer-sent"
                        } else if ("offer-received" === t.state) t.peerConnection.createAnswer(function(e) {
                            if (t.peerConnection.setLocalDescription(e), t.state = "offer-received-preparing-answer", t.iceStarted) t.markActionNeeded();
                            else {
                                var i = new Date;
                                le.debug(i.getTime() + ": Starting ICE in responder"), t.iceStarted = !0
                            }
                        }, function(e) {
                            le.debug("peer connection create answer failed ", e)
                        }, t.mediaConstraints);
                        else if ("offer-received-preparing-answer" === t.state) {
                            if (t.moreIceComing) return;
                            e = t.peerConnection.localDescription.sdp, t.sendMessage("ANSWER", e), t.state = "established"
                        } else t.error("Dazed and confused in state " + t.state + ", stopping here");
                        t.actionNeeded = !1
                    }
                }, t.sendOK = function() {
                    t.sendMessage("OK")
                }, t.sendMessage = function(e, i) {
                    var n = {};
                    n.messageType = e, n.sdp = i, "OFFER" === e ? (n.offererSessionId = t.sessionId, n.answererSessionId = t.otherSessionId, n.seq = t.sequenceNumber += 1, n.tiebreaker = Math.floor(429496723 * Math.random() + 1)) : (n.offererSessionId = t.incomingMessage.offererSessionId, n.answererSessionId = t.sessionId, n.seq = t.incomingMessage.seq), t.onsignalingmessage(JSON.stringify(n))
                }, t._getSender = function(e) {
                    if (t.peerConnection && t.peerConnection.getSenders) {
                        var i = t.peerConnection.getSenders().find(function(t) {
                            return t.track.kind == e
                        });
                        if (i) return i
                    }
                    return null
                }, t.hasSender = function(e) {
                    return !!t._getSender(e)
                }, t.replaceTrack = function(e, i, n) {
                    var o = t._getSender(e.kind);
                    if (!o) return n("NO_SENDER_FOUND");
                    try {
                        o.replaceTrack(e)
                    } catch (e) {
                        return n && n(e)
                    }
                    setTimeout(function() {
                        return i && i()
                    }, 50)
                }, t.error = function(e) {
                    throw "Error in RoapOnJsep: " + e
                }, t.sessionId = t.roapSessionId += 1, t.sequenceNumber = 0, t.actionNeeded = !1, t.iceStarted = !1, t.moreIceComing = !0, t.iceCandidateCount = 0, t.onsignalingmessage = e.callback, t.peerConnection.ontrack = function(e) {
                    t.onaddstream && (t.onaddstream(e, "ontrack"), t.peerConnection.onaddstream = null)
                }, t.peerConnection.onaddstream = function(e) {
                    t.onaddstream && (t.onaddstream(e, "onaddstream"), t.peerConnection.ontrack = null)
                }, t.peerConnection.onremovestream = function(e) {
                    t.onremovestream && t.onremovestream(e)
                }, t.peerConnection.oniceconnectionstatechange = function(e) {
                    "connected" === e.currentTarget.iceConnectionState && (t.connectedTime = new Date), t.oniceconnectionstatechange && t.oniceconnectionstatechange(e.currentTarget.iceConnectionState)
                }, t.peerConnection.onnegotiationneeded = function() {
                    void 0 !== t.prevOffer && t.peerConnection.createOffer().then(function(e) {
                        return e.sdp = e.sdp.replace(/a=recvonly\r\n/g, "a=inactive\r\n"), t.peerConnection.setLocalDescription(e)
                    }).then(function() {
                        t.onnegotiationneeded && t.onnegotiationneeded(t.peerConnection.localDescription.sdp)
                    }).catch(function(e) {
                        console.log("createOffer error: ", e)
                    })
                }, t.onaddstream = null, t.onremovestream = null, t.onnegotiationneeded = null, t.state = "new", t.markActionNeeded(), t
            },
            Ce = function(e) {
                var t = {};
                t.uid = e.uid, t.isVideoMute = e.isVideoMute, t.isAudioMute = e.isAudioMute, t.isSubscriber = e.isSubscriber, t.pc_config = {
                    iceServers: [{
                        urls: ["stun:webcs.agora.io:3478", "stun:stun.l.google.com:19302"]
                    }],
                    bundlePolicy: "max-bundle"
                }, t.con = {
                    optional: [{
                        DtlsSrtpKeyAgreement: !0
                    }]
                }, e.iceServers instanceof Array ? t.pc_config.iceServers = e.iceServers : (e.stunServerUrl && (e.stunServerUrl instanceof Array ? e.stunServerUrl.map(function(e) {
                    "string" == typeof e && "" !== e && t.pc_config.iceServers.push({
                        url: e
                    })
                }) : "string" == typeof e.stunServerUrl && "" !== e.stunServerUrl && t.pc_config.iceServers.push({
                    url: e.stunServerUrl
                })), e.turnServer && (e.turnServer instanceof Array ? e.turnServer.map(function(e) {
                    "string" == typeof e.url && "" !== e.url && t.pc_config.iceServers.push({
                        username: e.username,
                        credential: e.password,
                        url: e.url
                    })
                }) : "string" == typeof e.turnServer.url && "" !== e.turnServer.url && (t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.credential,
                    credentialType: "password",
                    urls: ["turn:" + e.turnServer.url + ":" + e.turnServer.udpport + "?transport=udp"]
                }), "string" == typeof e.turnServer.tcpport && "" !== e.turnServer.tcpport && t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.credential,
                    credentialType: "password",
                    urls: ["turn:" + e.turnServer.url + ":" + e.turnServer.tcpport + "?transport=tcp"]
                }), !0 === e.turnServer.forceturn && (t.pc_config.iceTransportPolicy = "relay")))), void 0 === e.audio && (e.audio = !0), void 0 === e.video && (e.video = !0), t.mediaConstraints = {
                    mandatory: {
                        OfferToReceiveVideo: e.video,
                        OfferToReceiveAudio: e.audio
                    }
                }, t.roapSessionId = 103, t.peerConnection = new P(t.pc_config), le.debug('safari Created RTCPeerConnnection with config "' + JSON.stringify(t.pc_config) + '".'), t.peerConnection.onicecandidate = function(e) {
                    var i, n, o, r;
                    n = (i = t.peerConnection.localDescription.sdp).match(/a=candidate:.+typ\ssrflx.+\r\n/), o = i.match(/a=candidate:.+typ\shost.+\r\n/), r = i.match(/a=candidate:.+typ\srelay.+\r\n/), 0 === t.iceCandidateCount && (t.timeout = setTimeout(function() {
                        t.moreIceComing && (t.moreIceComing = !1, t.markActionNeeded())
                    }, 1e3)), null === n && null === o && null === r || void 0 !== t.ice || (le.debug("srflx candidate : " + n + " relay candidate: " + r + " host candidate : " + o), clearTimeout(t.timeout), t.ice = 0, t.moreIceComing = !1, t.markActionNeeded()), t.iceCandidateCount = t.iceCandidateCount + 1
                };
                var i = function(t) {
                        return e.screen && (t = t.replace("a=x-google-flag:conference\r\n", "")), t
                    },
                    n = function(t) {
                        var i, n;
                        return e.minVideoBW && e.maxVideoBW && (n = (i = t.match(/m=video.*\r\n/))[0] + "b=AS:" + e.maxVideoBW + "\r\n", t = t.replace(i[0], n), le.debug("Set Video Bitrate - min:" + e.minVideoBW + " max:" + e.maxVideoBW)), e.maxAudioBW && (n = (i = t.match(/m=audio.*\r\n/))[0] + "b=AS:" + e.maxAudioBW + "\r\n", t = t.replace(i[0], n)), t
                    };
                t.processSignalingMessage = function(e) {
                    var o, r = JSON.parse(e);
                    t.incomingMessage = r, "new" === t.state ? "OFFER" === r.messageType ? (o = {
                        sdp: r.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(o)), t.state = "offer-received", t.markActionNeeded()) : t.error("Illegal message for this state: " + r.messageType + " in state " + t.state) : "offer-sent" === t.state ? "ANSWER" === r.messageType ? ((o = {
                        sdp: r.sdp,
                        type: "answer"
                    }).sdp = i(o.sdp), o.sdp = n(o.sdp), o.sdp = o.sdp.replace(/a=x-google-flag:conference\r\n/g, ""), t.peerConnection.setRemoteDescription(new RTCSessionDescription(o)), t.sendOK(), t.state = "established") : "pr-answer" === r.messageType ? (o = {
                        sdp: r.sdp,
                        type: "pr-answer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(o))) : "offer" === r.messageType ? t.error("Not written yet") : t.error("Illegal message for this state: " + r.messageType + " in state " + t.state) : "established" === t.state && ("OFFER" === r.messageType ? (o = {
                        sdp: r.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new RTCSessionDescription(o)), t.state = "offer-received", t.markActionNeeded()) : "ANSWER" === r.messageType ? ((o = {
                        sdp: r.sdp,
                        type: "answer"
                    }).sdp = i(o.sdp), o.sdp = n(o.sdp), t.peerConnection.setRemoteDescription(new RTCSessionDescription(o))) : t.error("Illegal message for this state: " + r.messageType + " in state " + t.state))
                };
                var o = {
                        id: "",
                        type: "",
                        mediaType: "",
                        googCodecName: "opus",
                        aecDivergentFilterFraction: "0",
                        audioInputLevel: "0",
                        bytesSent: "0",
                        packetsSent: "0",
                        googEchoCancellationReturnLoss: "0",
                        googEchoCancellationReturnLossEnhancement: "0"
                    },
                    r = {
                        id: "",
                        type: "",
                        mediaType: "",
                        googCodecName: "h264" === e.codec ? "H264" : "VP8",
                        bytesSent: "0",
                        packetsLost: "0",
                        packetsSent: "0",
                        googAdaptationChanges: "0",
                        googAvgEncodeMs: "0",
                        googEncodeUsagePercent: "0",
                        googFirsReceived: "0",
                        googFrameHeightSent: "0",
                        googFrameHeightInput: "0",
                        googFrameRateInput: "0",
                        googFrameRateSent: "0",
                        googFrameWidthSent: "0",
                        googFrameWidthInput: "0",
                        googNacksReceived: "0",
                        googPlisReceived: "0",
                        googRtt: "0",
                        googFramesEncoded: "0"
                    },
                    a = {
                        id: "",
                        type: "",
                        mediaType: "",
                        audioOutputLevel: "0",
                        bytesReceived: "0",
                        packetsLost: "0",
                        packetsReceived: "0",
                        googAccelerateRate: "0",
                        googCurrentDelayMs: "0",
                        googDecodingCNG: "0",
                        googDecodingCTN: "0",
                        googDecodingCTSG: "0",
                        googDecodingNormal: "0",
                        googDecodingPLC: "0",
                        googDecodingPLCCNG: "0",
                        googExpandRate: "0",
                        googJitterBufferMs: "0",
                        googJitterReceived: "0",
                        googPreemptiveExpandRate: "0",
                        googPreferredJitterBufferMs: "0",
                        googSecondaryDecodedRate: "0",
                        googSpeechExpandRate: "0"
                    },
                    s = {
                        id: "",
                        type: "",
                        mediaType: "",
                        googTargetDelayMs: "0",
                        packetsLost: "0",
                        googDecodeMs: "0",
                        googMaxDecodeMs: "0",
                        googRenderDelayMs: "0",
                        googFrameWidthReceived: "0",
                        googFrameHeightReceived: "0",
                        googFrameRateReceived: "0",
                        googFrameRateDecoded: "0",
                        googFrameRateOutput: "0",
                        googFramesDecoded: "0",
                        googFrameReceived: "0",
                        googJitterBufferMs: "0",
                        googCurrentDelayMs: "0",
                        googMinPlayoutDelayMs: "0",
                        googNacksSent: "0",
                        googPlisSent: "0",
                        googFirsSent: "0",
                        bytesReceived: "0",
                        packetsReceived: "0"
                    },
                    d = {
                        id: "bweforvideo",
                        type: "VideoBwe",
                        googAvailableSendBandwidth: "0",
                        googAvailableReceiveBandwidth: "0",
                        googActualEncBitrate: "0",
                        googRetransmitBitrate: "0",
                        googTargetEncBitrate: "0",
                        googBucketDelay: "0",
                        googTransmitBitrate: "0"
                    },
                    c = 0,
                    u = 0,
                    l = 0;
                return t.getVideoRelatedStats = function(i) {
                    t.peerConnection.getStats().then(function(n) {
                        n.forEach(function(n) {
                            if (t.isSubscriber) {
                                if ("track" === n.type && (~n.id.indexOf("video") || ~n.trackIdentifier.indexOf("v"))) {
                                    if (!t.lastReport) return void(t.lastReport = n);
                                    i && i({
                                        peerId: t.uid,
                                        mediaType: "video",
                                        isVideoMute: t.isVideoMute,
                                        frameRateReceived: n.framesReceived - t.lastReport.framesReceived + "",
                                        frameRateDecoded: n.framesDecoded - t.lastReport.framesDecoded + ""
                                    }), t.lastReport = n
                                }
                            } else if ("outbound-rtp" === n.type && "video" === n.mediaType) {
                                if (!t.lastReport) return void(t.lastReport = n);
                                i && i({
                                    mediaType: "video",
                                    isVideoMute: t.isVideoMute,
                                    frameRateInput: e.maxFrameRate + "",
                                    frameRateSent: n.framesEncoded - t.lastReport.framesEncoded + ""
                                }), t.lastReport = n
                            }
                        })
                    })
                }, t.getAudioRelatedStats = function(e) {
                    t.peerConnection.getStats().then(function(i) {
                        i.forEach(function(i) {
                            t.isSubscriber && "inbound-rtp" === i.type && ~i.id.indexOf("Audio") && e && e({
                                peerId: t.uid,
                                mediaType: "audio",
                                isAudioMute: t.isAudioMute,
                                frameDropped: i.packetsLost + "",
                                frameReceived: i.packetsReceived + ""
                            })
                        })
                    })
                }, t.getStatsRate = function(e) {
                    t.getStats(function(t) {
                        t.forEach(function(e) {
                            "outbound-rtp" === e.type && "video" === e.mediaType && e.googFramesEncoded && (e.googFrameRateSent = ((e.googFramesEncoded - c) / 3).toString(), c = e.googFramesEncoded), "inbound-rtp" === e.type && -1 != e.id.indexOf("55543") && (e.googFrameRateReceived && (e.googFrameRateReceived = ((e.googFrameReceived - l) / 3).toString(), l = e.googFrameReceived), e.googFrameRateDecoded && (e.googFrameRateDecoded = ((e.googFramesDecoded - u) / 3).toString(), u = e.googFramesDecoded))
                        }), e(t)
                    })
                }, t.getStats = function(e) {
                    var i = [];
                    t.peerConnection.getStats().then(function(n) {
                        n.forEach(function(e) {
                            i.push(e), "outbound-rtp" === e.type && "audio" === e.mediaType && (o.id = e.id, o.type = e.type, o.mediaType = e.mediaType, o.bytesSent = e.bytesSent ? e.bytesSent + "" : "0", o.packetsSent = e.packetsSent ? e.packetsSent + "" : "0"), "outbound-rtp" === e.type && "video" === e.mediaType && (r.id = e.id, r.type = e.type, r.mediaType = e.mediaType, r.bytesSent = e.bytesSent ? e.bytesSent + "" : "0", r.packetsSent = e.packetsSent ? e.packetsSent + "" : "0", r.googPlisReceived = e.pliCount ? e.pliCount + "" : "0", r.googNacksReceived = e.nackCount ? e.nackCount + "" : "0", r.googFirsReceived = e.firCount ? e.firCount + "" : "0", r.googFramesEncoded = e.framesEncoded ? e.framesEncoded + "" : "0"), "inbound-rtp" === e.type && -1 != e.id.indexOf("44444") && (a.id = e.id, a.type = e.type, a.mediaType = "audio", a.packetsReceived = e.packetsReceived ? e.packetsReceived + "" : "0", a.bytesReceived = e.bytesReceived ? e.bytesReceived + "" : "0", a.packetsLost = e.packetsLost ? e.packetsLost + "" : "0", a.packetsReceived = e.packetsReceived ? e.packetsReceived + "" : "0", a.googJitterReceived = e.jitter ? e.jitter + "" : "0"), "inbound-rtp" === e.type && -1 != e.id.indexOf("55543") && (s.id = e.id, s.type = e.type, s.mediaType = "video", s.packetsReceived = e.packetsReceived ? e.packetsReceived + "" : "0", s.bytesReceived = e.bytesReceived ? e.bytesReceived + "" : "0", s.packetsLost = e.packetsLost ? e.packetsLost + "" : "0", s.googJitterBufferMs = e.jitter ? e.jitter + "" : "0", s.googNacksSent = e.nackCount ? e.nackCount + "" : "0", s.googPlisSent = e.pliCount ? e.pliCount + "" : "0", s.googFirsSent = e.firCount ? e.firCount + "" : "0"), "track" !== e.type || -1 == e.id.indexOf("55543") && !~e.trackIdentifier.indexOf("v") || (s.googFrameWidthReceived = e.frameWidth ? e.frameWidth + "" : "0", s.googFrameHeightReceived = e.frameHeight ? e.frameHeight + "" : "0", s.googFrameReceived = e.framesReceived ? e.framesReceived + "" : "0", s.googFramesDecoded = e.framesDecoded ? e.framesDecoded + "" : "0"), "track" !== e.type || -1 == e.id.indexOf("44444") && !~e.trackIdentifier.indexOf("a") || (a.audioOutputLevel = e.audioLevel + "", o.audioInputLevel = e.audioLevel + ""), "candidate-pair" === e.type && (0 == e.availableIncomingBitrate ? d.googAvailableSendBandwidth = e.availableOutgoingBitrate + "" : d.googAvailableReceiveBandwidth = e.availableIncomingBitrate + "")
                        });
                        var c = [d, o, r, a, s];
                        c.push({
                            id: "time",
                            startTime: t.connectedTime,
                            timestamp: new Date
                        }), e(c, i)
                    }).catch(function(e) {
                        console.error(e)
                    })
                }, t.addTrack = function(e, i) {
                    t.peerConnection.addTrack(e, i)
                }, t.removeTrack = function(e, i) {
                    var n = t.peerConnection.getSenders().find(function(t) {
                        return t.track == e
                    });
                    n.replaceTrack(null), t.peerConnection.removeTrack(n)
                }, t.addStream = function(e) {
                    window.navigator.userAgent.indexOf("Safari") > -1 && -1 === navigator.userAgent.indexOf("Chrome") ? e.getTracks().forEach(function(i) {
                        return t.peerConnection.addTrack(i, e)
                    }) : t.peerConnection.addStream(e), t.markActionNeeded()
                }, t.removeStream = function() {
                    t.markActionNeeded()
                }, t.close = function() {
                    t.state = "closed", t.peerConnection.close()
                }, t.markActionNeeded = function() {
                    t.actionNeeded = !0, t.doLater(function() {
                        t.onstablestate()
                    })
                }, t.doLater = function(e) {
                    window.setTimeout(e, 1)
                }, t.onstablestate = function() {
                    var i;
                    if (t.actionNeeded) {
                        if ("new" === t.state || "established" === t.state) {
                            if (e.isSubscriber && window.navigator.userAgent.indexOf("Safari") > -1 && -1 === navigator.userAgent.indexOf("Chrome")) {
                                var o = t.peerConnection.addTransceiver("audio"),
                                    r = t.peerConnection.addTransceiver("video");
                                o.setDirection("recvonly"), r.setDirection("recvonly")
                            }
                            t.peerConnection.createOffer(t.mediaConstraints).then(function(i) {
                                if (i.sdp = n(i.sdp), e.isSubscriber || (i.sdp = i.sdp.replace(/a=extmap:4 urn:3gpp:video-orientation\r\n/g, "")), i.sdp !== t.prevOffer) return t.peerConnection.setLocalDescription(i), t.state = "preparing-offer", void t.markActionNeeded();
                                le.debug("Not sending a new offer")
                            }).catch(function(e) {
                                le.debug("peer connection create offer failed ", e)
                            })
                        } else if ("preparing-offer" === t.state) {
                            if (t.moreIceComing) return;
                            t.prevOffer = t.peerConnection.localDescription.sdp, t.prevOffer = t.prevOffer.replace(/a=candidate:.+typ\shost.+\r\n/g, "a=candidate:2243255435 1 udp 2122194687 192.168.0.1 30000 typ host generation 0 network-id 1\r\n"), t.sendMessage("OFFER", t.prevOffer), t.state = "offer-sent"
                        } else if ("offer-received" === t.state) t.peerConnection.createAnswer(function(e) {
                            if (t.peerConnection.setLocalDescription(e), t.state = "offer-received-preparing-answer", t.iceStarted) t.markActionNeeded();
                            else {
                                var i = new Date;
                                le.debug(i.getTime() + ": Starting ICE in responder"), t.iceStarted = !0
                            }
                        }, function(e) {
                            le.debug("peer connection create answer failed ", e)
                        }, t.mediaConstraints);
                        else if ("offer-received-preparing-answer" === t.state) {
                            if (t.moreIceComing) return;
                            i = t.peerConnection.localDescription.sdp, t.sendMessage("ANSWER", i), t.state = "established"
                        } else t.error("Dazed and confused in state " + t.state + ", stopping here");
                        t.actionNeeded = !1
                    }
                }, t.sendOK = function() {
                    t.sendMessage("OK")
                }, t.sendMessage = function(e, i) {
                    var n = {};
                    n.messageType = e, n.sdp = i, "OFFER" === e ? (n.offererSessionId = t.sessionId, n.answererSessionId = t.otherSessionId, n.seq = t.sequenceNumber += 1, n.tiebreaker = Math.floor(429496723 * Math.random() + 1)) : (n.offererSessionId = t.incomingMessage.offererSessionId, n.answererSessionId = t.sessionId, n.seq = t.incomingMessage.seq), t.onsignalingmessage(JSON.stringify(n))
                }, t._getSender = function(e) {
                    if (t.peerConnection && t.peerConnection.getSenders) {
                        var i = t.peerConnection.getSenders().find(function(t) {
                            return t.track.kind == e
                        });
                        if (i) return i
                    }
                    return null
                }, t.hasSender = function(e) {
                    return !!t._getSender(e)
                }, t.replaceTrack = function(e, i, n) {
                    var o = t._getSender(e.kind);
                    if (!o) return n("NO_SENDER_FOUND");
                    try {
                        o.replaceTrack(e)
                    } catch (e) {
                        return n && n(e)
                    }
                    setTimeout(function() {
                        return i && i()
                    }, 50)
                }, t.error = function(e) {
                    throw "Error in RoapOnJsep: " + e
                }, t.sessionId = t.roapSessionId += 1, t.sequenceNumber = 0, t.actionNeeded = !1, t.iceStarted = !1, t.moreIceComing = !0, t.iceCandidateCount = 0, t.onsignalingmessage = e.callback, t.peerConnection.ontrack = function(e) {
                    t.onaddstream && t.onaddstream(e, "ontrack")
                }, t.peerConnection.onremovestream = function(e) {
                    t.onremovestream && t.onremovestream(e)
                }, t.peerConnection.oniceconnectionstatechange = function(e) {
                    "connected" === e.currentTarget.iceConnectionState && (t.connectedTime = new Date), t.oniceconnectionstatechange && t.oniceconnectionstatechange(e.currentTarget.iceConnectionState)
                }, t.peerConnection.onnegotiationneeded = function() {
                    void 0 !== t.prevOffer && t.peerConnection.createOffer().then(function(e) {
                        return e.sdp = e.sdp.replace(/a=recvonly\r\n/g, "a=inactive\r\n"), t.peerConnection.setLocalDescription(e)
                    }).then(function() {
                        t.onnegotiationneeded && t.onnegotiationneeded(t.peerConnection.localDescription.sdp)
                    }).catch(function(e) {
                        console.log("createOffer error: ", e)
                    })
                }, t.onaddstream = null, t.onremovestream = null, t.state = "new", t.markActionNeeded(), t
            },
            Ne = function() {
                var e = {
                    addStream: function() {}
                };
                return e
            },
            we = function(e) {
                var t = {},
                    i = (mozRTCPeerConnection, mozRTCSessionDescription),
                    n = !1;
                t.uid = e.uid, t.isVideoMute = e.isVideoMute, t.isAudioMute = e.isAudioMute, t.isSubscriber = e.isSubscriber, t.pc_config = {
                    iceServers: []
                }, e.iceServers instanceof Array ? e.iceServers.map(function(e) {
                    0 === e.url.indexOf("stun:") && t.pc_config.iceServers.push({
                        url: e.url
                    })
                }) : (e.stunServerUrl && (e.stunServerUrl instanceof Array ? e.stunServerUrl.map(function(e) {
                    "string" == typeof e && "" !== e && t.pc_config.iceServers.push({
                        url: e
                    })
                }) : "string" == typeof e.stunServerUrl && "" !== e.stunServerUrl && t.pc_config.iceServers.push({
                    url: e.stunServerUrl
                })), e.turnServer && "string" == typeof e.turnServer.url && "" !== e.turnServer.url && (t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.credential,
                    credentialType: "password",
                    urls: "turn:" + e.turnServer.url + ":" + e.turnServer.udpport + "?transport=udp"
                }), "string" == typeof e.turnServer.tcpport && "" !== e.turnServer.tcpport && t.pc_config.iceServers.push({
                    username: e.turnServer.username,
                    credential: e.turnServer.credential,
                    credentialType: "password",
                    urls: "turn:" + e.turnServer.url + ":" + e.turnServer.tcpport + "?transport=tcp"
                }), !0 === e.turnServer.forceturn && (t.pc_config.iceTransportPolicy = "relay"))), void 0 === e.audio && (e.audio = !0), void 0 === e.video && (e.video = !0), t.mediaConstraints = {
                    offerToReceiveAudio: e.audio,
                    offerToReceiveVideo: e.video,
                    mozDontOfferDataChannel: !0
                }, t.roapSessionId = 103, t.peerConnection = new P(t.pc_config), le.debug('safari Created RTCPeerConnnection with config "' + JSON.stringify(t.pc_config) + '".'), t.peerConnection.onicecandidate = function(e) {
                    var i, n, o, r;
                    n = (i = t.peerConnection.localDescription.sdp).match(/a=candidate:.+typ\ssrflx.+\r\n/), o = i.match(/a=candidate:.+typ\shost.+\r\n/), r = i.match(/a=candidate:.+typ\srelay.+\r\n/), 0 === t.iceCandidateCount && (t.timeout = setTimeout(function() {
                        t.moreIceComing && (t.moreIceComing = !1, t.markActionNeeded())
                    }, 1e3)), null === n && null === o && null === r || void 0 !== t.ice || (le.debug("srflx candidate : " + n + " relay candidate: " + r + " host candidate : " + o), clearTimeout(t.timeout), t.ice = 0, t.moreIceComing = !1, t.markActionNeeded()), t.iceCandidateCount = t.iceCandidateCount + 1
                }, t.checkMLineReverseInSDP = function(e) {
                    return !(!~e.indexOf("m=audio") || !~e.indexOf("m=video")) && e.indexOf("m=audio") > e.indexOf("m=video")
                }, t.reverseMLineInSDP = function(e) {
                    var t = e.split("m=audio"),
                        i = t[1].split("m=video"),
                        n = "m=video" + i[1],
                        o = "m=audio" + i[0];
                    return e = t[0] + n + o
                }, t.processSignalingMessage = function(e) {
                    var n, o = JSON.parse(e);
                    t.incomingMessage = o, "new" === t.state ? "OFFER" === o.messageType ? (o.sdp = c(o.sdp), n = {
                        sdp: o.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new i(n), function() {
                        le.debug("setRemoteDescription succeeded")
                    }, function(e) {
                        le.info("setRemoteDescription failed: " + e.name)
                    }), t.state = "offer-received", t.markActionNeeded()) : t.error("Illegal message for this state: " + o.messageType + " in state " + t.state) : "offer-sent" === t.state ? "ANSWER" === o.messageType ? (o.sdp = c(o.sdp), o.sdp = o.sdp.replace(/ generation 0/g, ""), o.sdp = o.sdp.replace(/ udp /g, " UDP "), o.sdp = o.sdp.replace(/a=group:BUNDLE audio video/, "a=group:BUNDLE sdparta_0 sdparta_1"), o.sdp = o.sdp.replace(/a=mid:audio/, "a=mid:sdparta_0"), o.sdp = o.sdp.replace(/a=mid:video/, "a=mid:sdparta_1"), t.isMLineReverseInSDP && (o.sdp = t.reverseMLineInSDP(o.sdp)), n = {
                        sdp: o.sdp,
                        type: "answer"
                    }, t.peerConnection.setRemoteDescription(new i(n), function() {
                        le.debug("setRemoteDescription succeeded")
                    }, function(e) {
                        le.info("setRemoteDescription failed: " + e)
                    }), t.sendOK(), t.state = "established") : "pr-answer" === o.messageType ? (n = {
                        sdp: o.sdp,
                        type: "pr-answer"
                    }, t.peerConnection.setRemoteDescription(new i(n), function() {
                        le.debug("setRemoteDescription succeeded")
                    }, function(e) {
                        le.info("setRemoteDescription failed: " + e.name)
                    })) : "offer" === o.messageType ? t.error("Not written yet") : t.error("Illegal message for this state: " + o.messageType + " in state " + t.state) : "established" === t.state && ("OFFER" === o.messageType ? (n = {
                        sdp: o.sdp,
                        type: "offer"
                    }, t.peerConnection.setRemoteDescription(new i(n), function() {
                        le.debug("setRemoteDescription succeeded")
                    }, function(e) {
                        le.info("setRemoteDescription failed: " + e.name)
                    }), t.state = "offer-received", t.markActionNeeded()) : t.error("Illegal message for this state: " + o.messageType + " in state " + t.state))
                };
                var o = {
                        id: "",
                        type: "",
                        mediaType: "opus",
                        googCodecName: "opus",
                        aecDivergentFilterFraction: "0",
                        audioInputLevel: "0",
                        bytesSent: "0",
                        packetsSent: "0",
                        googEchoCancellationReturnLoss: "0",
                        googEchoCancellationReturnLossEnhancement: "0"
                    },
                    r = {
                        id: "",
                        type: "",
                        mediaType: "",
                        googCodecName: "h264" === e.codec ? "H264" : "VP8",
                        bytesSent: "0",
                        packetsLost: "0",
                        packetsSent: "0",
                        googAdaptationChanges: "0",
                        googAvgEncodeMs: "0",
                        googEncodeUsagePercent: "0",
                        googFirsReceived: "0",
                        googFrameHeightSent: "0",
                        googFrameHeightInput: "0",
                        googFrameRateInput: "0",
                        googFrameRateSent: "0",
                        googFrameWidthSent: "0",
                        googFrameWidthInput: "0",
                        googNacksReceived: "0",
                        googPlisReceived: "0",
                        googRtt: "0"
                    },
                    a = {
                        id: "",
                        type: "",
                        mediaType: "",
                        audioOutputLevel: "0",
                        bytesReceived: "0",
                        packetsLost: "0",
                        packetsReceived: "0",
                        googAccelerateRate: "0",
                        googCurrentDelayMs: "0",
                        googDecodingCNG: "0",
                        googDecodingCTN: "0",
                        googDecodingCTSG: "0",
                        googDecodingNormal: "0",
                        googDecodingPLC: "0",
                        googDecodingPLCCNG: "0",
                        googExpandRate: "0",
                        googJitterBufferMs: "0",
                        googJitterReceived: "0",
                        googPreemptiveExpandRate: "0",
                        googPreferredJitterBufferMs: "0",
                        googSecondaryDecodedRate: "0",
                        googSpeechExpandRate: "0"
                    },
                    s = {
                        id: "",
                        type: "",
                        mediaType: "",
                        googTargetDelayMs: "0",
                        packetsLost: "0",
                        googDecodeMs: "0",
                        googMaxDecodeMs: "0",
                        googRenderDelayMs: "0",
                        googFrameWidthReceived: "0",
                        googFrameHeightReceived: "0",
                        googFrameRateReceived: "0",
                        googFrameRateDecoded: "0",
                        googFrameRateOutput: "0",
                        googJitterBufferMs: "0",
                        googCurrentDelayMs: "0",
                        googMinPlayoutDelayMs: "0",
                        googNacksSent: "0",
                        googPlisSent: "0",
                        googFirsSent: "0",
                        bytesReceived: "0",
                        packetsReceived: "0",
                        googFramesDecoded: "0"
                    },
                    d = 0;
                t.getVideoRelatedStats = function(e) {
                    t.peerConnection.getStats().then(function(i) {
                        Object.keys(i).forEach(function(n) {
                            var o = i[n];
                            if (t.isSubscriber) {
                                if ("inboundrtp" === o.type && "video" === o.mediaType) {
                                    if (!t.lastReport) return void(t.lastReport = o);
                                    e && e({
                                        browser: "firefox",
                                        mediaType: "video",
                                        peerId: t.uid,
                                        isVideoMute: t.isVideoMute,
                                        frameRateReceived: o.framerateMean + "",
                                        frameRateDecoded: o.framesDecoded - t.lastReport.framesDecoded + ""
                                    }), t.lastReport = o
                                }
                            } else if ("outboundrtp" === o.type && "video" === o.mediaType) {
                                if (!t.lastReport) return void(t.lastReport = o);
                                e && e({
                                    mediaType: "video",
                                    isVideoMute: t.isVideoMute,
                                    frameRateInput: o.framerateMean + "",
                                    frameRateSent: o.framesEncoded - t.lastReport.framesEncoded + ""
                                }), t.lastReport = o
                            }
                        })
                    })
                }, t.getAudioRelatedStats = function(e) {
                    t.peerConnection.getStats().then(function(i) {
                        Object.keys(i).forEach(function(n) {
                            var o = i[n];
                            t.isSubscriber && "inboundrtp" === o.type && "audio" === o.mediaType && e && e({
                                browser: "firefox",
                                mediaType: "audio",
                                peerId: t.uid,
                                isAudioMute: t.isAudioMute,
                                frameDropped: o.packetsLost + "",
                                frameReceived: o.packetsReceived + ""
                            })
                        })
                    })
                }, t.getStatsRate = function(e) {
                    t.getStats(function(t) {
                        t.forEach(function(e) {
                            "inboundrtp" === e.type && "video" === e.mediaType && e.googFrameRateDecoded && (e.googFrameRateDecoded = ((e.googFramesDecoded - d) / 3).toString(), d = e.googFramesDecoded)
                        }), e(t)
                    })
                }, t.getStats = function(e) {
                    t.peerConnection.getStats().then(function(i) {
                        var n = [];
                        Object.keys(i).forEach(function(e) {
                            var t = i[e];
                            n.push(t), "outboundrtp" === t.type && "video" === t.mediaType && (r.id = t.id, r.type = t.type, r.mediaType = t.mediaType, r.bytesSent = t.bytesSent ? t.bytesSent + "" : "0", r.packetsSent = t.packetsSent ? t.packetsSent + "" : "0", r.googPlisReceived = t.pliCount ? t.pliCount + "" : "0", r.googNacksReceived = t.nackCount ? t.nackCount + "" : "0", r.googFirsReceived = t.firCount ? t.firCount + "" : "0", r.googFrameRateSent = t.framerateMean ? t.framerateMean + "" : "0"), "outboundrtp" === t.type && "audio" === t.mediaType && (o.id = t.id, o.type = t.type, o.mediaType = t.mediaType, o.bytesSent = t.bytesSent ? t.bytesSent + "" : "0", o.packetsSent = t.packetsSent ? t.packetsSent + "" : "0"), "inboundrtp" !== t.type || "audio" !== t.mediaType || t.isRemote || (a.id = t.id, a.type = t.type, a.mediaType = t.mediaType, a.bytesReceived = t.bytesReceived ? t.bytesReceived + "" : "0", a.packetsLost = t.packetsLost ? t.packetsLost + "" : "0", a.packetsReceived = t.packetsReceived ? t.packetsReceived + "" : "0", a.googJitterReceived = t.jitter ? t.jitter + "" : "0"), "inboundrtp" !== t.type || "video" !== t.mediaType || t.isRemote || (s.id = t.id, s.type = t.type, s.mediaType = t.mediaType, s.bytesReceived = t.bytesReceived ? t.bytesReceived + "" : "0", s.googFrameRateReceived = t.framerateMean ? t.framerateMean + "" : "0", s.googFramesDecoded = t.framesDecoded ? t.framesDecoded + "" : "0", s.packetsLost = t.packetsLost ? t.packetsLost + "" : "0", s.packetsReceived = t.packetsReceived ? t.packetsReceived + "" : "0", s.googJitterBufferMs = t.jitter ? t.jitter + "" : "0", s.googNacksSent = t.nackCount ? t.nackCount + "" : "0", s.googPlisSent = t.pliCount ? t.pliCount + "" : "0", s.googFirsSent = t.firCount ? t.firCount + "" : "0"), -1 !== t.id.indexOf("outbound_rtcp_video") && (r.packetsLost = t.packetsLost ? t.packetsLost + "" : "0")
                        });
                        var d = [r, o, a, s];
                        d.push({
                            id: "time",
                            startTime: t.connectedTime,
                            timestamp: new Date
                        }), e(d, n)
                    }, function(e) {
                        le.error(e)
                    })
                }, t.addStream = function(e) {
                    n = !0, t.peerConnection.addStream(e), t.markActionNeeded()
                }, t.removeStream = function() {
                    t.markActionNeeded()
                }, t.close = function() {
                    t.state = "closed", t.peerConnection.close()
                }, t.markActionNeeded = function() {
                    t.actionNeeded = !0, t.doLater(function() {
                        t.onstablestate()
                    })
                }, t.doLater = function(e) {
                    window.setTimeout(e, 1)
                }, t.onstablestate = function() {
                    if (t.actionNeeded) {
                        if ("new" === t.state || "established" === t.state) n && (t.mediaConstraints = void 0), t.peerConnection.createOffer(function(e) {
                            if (e.sdp = c(e.sdp), e.sdp = e.sdp.replace(/a=extmap:1 http:\/\/www.webrtc.org\/experiments\/rtp-hdrext\/abs-send-time/, "a=extmap:3 http://www.webrtc.org/experiments/rtp-hdrext/abs-send-time"), e.sdp !== t.prevOffer) return t.peerConnection.setLocalDescription(e), t.isMLineReverseInSDP = t.checkMLineReverseInSDP(e.sdp), t.state = "preparing-offer", void t.markActionNeeded();
                            le.debug("Not sending a new offer")
                        }, function(e) {
                            le.debug("Ups! create offer failed ", e)
                        }, t.mediaConstraints);
                        else if ("preparing-offer" === t.state) {
                            if (t.moreIceComing) return;
                            t.prevOffer = t.peerConnection.localDescription.sdp, t.prevOffer = t.prevOffer.replace(/a=candidate:.+typ\shost.+\r\n/g, "a=candidate:2243255435 1 udp 2122194687 192.168.0.1 30000 typ host generation 0 network-id 1\r\n"), t.sendMessage("OFFER", t.prevOffer), t.state = "offer-sent"
                        } else if ("offer-received" === t.state) t.peerConnection.createAnswer(function(e) {
                            if (t.peerConnection.setLocalDescription(e), t.state = "offer-received-preparing-answer", t.iceStarted) t.markActionNeeded();
                            else {
                                var i = new Date;
                                le.debug(i.getTime() + ": Starting ICE in responder"), t.iceStarted = !0
                            }
                        }, function() {
                            le.debug("Ups! Something went wrong")
                        });
                        else if ("offer-received-preparing-answer" === t.state) {
                            if (t.moreIceComing) return;
                            var e = t.peerConnection.localDescription.sdp;
                            t.sendMessage("ANSWER", e), t.state = "established"
                        } else t.error("Dazed and confused in state " + t.state + ", stopping here");
                        t.actionNeeded = !1
                    }
                }, t.sendOK = function() {
                    t.sendMessage("OK")
                }, t.sendMessage = function(e, i) {
                    var n = {};
                    n.messageType = e, n.sdp = i, "OFFER" === e ? (n.offererSessionId = t.sessionId, n.answererSessionId = t.otherSessionId, n.seq = t.sequenceNumber += 1, n.tiebreaker = Math.floor(429496723 * Math.random() + 1)) : (n.offererSessionId = t.incomingMessage.offererSessionId, n.answererSessionId = t.sessionId, n.seq = t.incomingMessage.seq), t.onsignalingmessage(JSON.stringify(n))
                }, t._getSender = function(e) {
                    if (t.peerConnection && t.peerConnection.getSenders) {
                        var i = t.peerConnection.getSenders().find(function(t) {
                            return t.track.kind == e
                        });
                        if (i) return i
                    }
                    return null
                }, t.hasSender = function(e) {
                    return !!t._getSender(e)
                }, t.replaceTrack = function(e, i, n) {
                    var o = t._getSender(e.kind);
                    if (!o) return n("NO_SENDER_FOUND");
                    try {
                        o.replaceTrack(e)
                    } catch (e) {
                        return n && n(e)
                    }
                    setTimeout(function() {
                        return i && i()
                    }, 50)
                }, t.error = function(e) {
                    throw "Error in RoapOnJsep: " + e
                }, t.sessionId = t.roapSessionId += 1, t.sequenceNumber = 0, t.actionNeeded = !1, t.iceStarted = !1, t.moreIceComing = !0, t.iceCandidateCount = 0, t.onsignalingmessage = e.callback, t.peerConnection.ontrack = function(e) {
                    t.onaddstream && t.onaddstream(e, "ontrack")
                }, t.peerConnection.onremovestream = function(e) {
                    t.onremovestream && t.onremovestream(e)
                }, t.peerConnection.oniceconnectionstatechange = function(e) {
                    "connected" === e.currentTarget.iceConnectionState && (t.connectedTime = new Date), t.oniceconnectionstatechange && t.oniceconnectionstatechange(e.currentTarget.iceConnectionState)
                };
                var c = function(t) {
                    var i;
                    if (e.video && e.maxVideoBW && (null == (i = t.match(/m=video.*\r\n/)) && (i = t.match(/m=video.*\n/)), i && i.length > 0)) {
                        var n = i[0] + "b=TIAS:" + 1e3 * e.maxVideoBW + "\r\n";
                        t = t.replace(i[0], n)
                    }
                    return e.audio && e.maxAudioBW && (null == (i = t.match(/m=audio.*\r\n/)) && (i = t.match(/m=audio.*\n/)), i && i.length > 0) && (n = i[0] + "b=TIAS:" + 1e3 * e.maxAudioBW + "\r\n", t = t.replace(i[0], n)), t
                };
                return t.onaddstream = null, t.onremovestream = null, t.state = "new", t.markActionNeeded(), t
            },
            Oe = null,
            De = function() {
                try {
                    Oe = window.require("electron")
                } catch (e) {}
                return Oe
            },
            Me = function(e) {
                var t = De();
                if (!t) return e && e("electron is null");
                t.desktopCapturer.getSources({
                    types: ["window", "screen"]
                }, function(t, i) {
                    if (t) return e && e(t);
                    e && e(null, i)
                })
            },
            ke = function(e, t, i) {
                var n = t.attributes.width;
                t = {
                    audio: !1,
                    video: {
                        mandatory: {
                            chromeMediaSource: "desktop",
                            chromeMediaSourceId: e,
                            maxHeight: t.attributes.height,
                            maxWidth: n,
                            maxFrameRate: t.attributes.maxFr,
                            minFrameRate: t.attributes.minFr
                        }
                    }
                };
                navigator.webkitGetUserMedia(t, function(e) {
                    i && i(null, e)
                }, function(e) {
                    i && i(e)
                })
            },
            Le = function() {
                return !!De()
            },
            xe = Me,
            Pe = ke,
            Ve = function(e, t) {
                Me(function(i, n) {
                    if (i) return t && t(i);
                    ! function(e, t) {
                        var i = document.createElement("div");
                        i.innerText = "share screen", i.setAttribute("style", "text-align: center; height: 25px; line-height: 25px; border-radius: 4px 4px 0 0; background: #D4D2D4; border-bottom:  solid 1px #B9B8B9;");
                        var n = document.createElement("div");
                        n.setAttribute("style", "width: 100%; height: 500px; padding: 15px 25px ; box-sizing: border-box;");
                        var o = document.createElement("div");
                        o.innerText = "Agora Web Screensharing wants to share the contents of your screen with webdemo.agorabeckon.com. Choose what you'd like to share.", o.setAttribute("style", "height: 12%;");
                        var r = document.createElement("div");
                        r.setAttribute("style", "width: 100%; height: 80%; background: #FFF; border:  solid 1px #CBCBCB; display: flex; flex-wrap: wrap; justify-content: space-around; overflow-y: scroll; padding: 0 15px; box-sizing: border-box;");
                        var a = document.createElement("div");
                        a.setAttribute("style", "text-align: right; padding: 16px 0;");
                        var s = document.createElement("button");
                        s.innerHTML = "cancel", s.setAttribute("style", "width: 85px;"), s.onclick = function() {
                            document.body.removeChild(d), t && t("NotAllowedError")
                        }, a.appendChild(s), n.appendChild(o), n.appendChild(r), n.appendChild(a);
                        var d = document.createElement("div");
                        d.setAttribute("style", "position: absolute; z-index: 99999999; top: 50%; left: 50%; width: 620px; height: 525px; background: #ECECEC; border-radius: 4px; -webkit-transform: translate(-50%,-50%); transform: translate(-50%,-50%);"), d.appendChild(i), d.appendChild(n), document.body.appendChild(d), e.map(function(e) {
                            if (e.id) {
                                var i = document.createElement("div");
                                i.setAttribute("style", "width: 30%; height: 160px; padding: 20px 0; text-align: center;box-sizing: content-box;"), i.innerHTML = '<div style="height: 120px; display: table-cell; vertical-align: middle;"><img style="width: 100%; background: #333333; box-shadow: 1px 1px 1px 1px rgba(0, 0, 0, 0.2);" src=' + e.thumbnail.toDataURL() + ' /></div><span style="\theight: 40px; line-height: 40px; display: inline-block; width: 70%; word-break: keep-all; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">' + e.name + "</span>", i.onclick = function() {
                                    document.body.removeChild(d), t && t(null, e.id)
                                }, r.appendChild(i)
                            }
                        })
                    }(n, function(i, n) {
                        if (i) return t && t(i);
                        ke(n, e, t)
                    })
                })
            },
            Fe = 103,
            Be = function(e) {
                var t = {};
                if (e.session_id = Fe += 1, "undefined" != typeof window && window.navigator)
                    if (null !== window.navigator.userAgent.match("Firefox")) t.browser = "mozilla", t = we(e);
                    else if (window.navigator.userAgent.indexOf("Safari") > -1 && -1 === navigator.userAgent.indexOf("Chrome")) le.debug("Safari"), (t = Ce(e)).browser = "safari";
                else if (window.navigator.userAgent.indexOf("MSIE "))(t = Te(e)).browser = "ie";
                else if (window.navigator.appVersion.match(/Chrome\/([\w\W]*?)\./)[1] >= 26)(t = Te(e)).browser = "chrome-stable";
                else {
                    if (!(window.navigator.userAgent.toLowerCase().indexOf("chrome") >= 40)) throw t.browser = "none", "WebRTC stack not available";
                    (t = Re(e)).browser = "chrome-canary"
                } else le.error("Publish/subscribe video/audio streams not supported yet"), t = Ne(e);
                return t
            },
            Ue = function(e, t, i) {
                if (navigator.getMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia, e.screen) {
                    if (Le()) return e.sourceId ? Pe(e.sourceId, e, function(e, n) {
                        if (e) return i && i();
                        t && t(n)
                    }) : Ve(e, function(e, n) {
                        if (e) return i && i();
                        t && t(n)
                    });
                    if (le.debug("Screen access requested"), null !== window.navigator.userAgent.match("Firefox")) {
                        if (!~["screen", "window", "application"].indexOf(e.mediaSource)) return i && i("Invalid mediaSource, mediaSource should be one of [screen, window, application]");
                        if (!e.attributes) return i && i("Share screen attributes is null");
                        var n = {};
                        n.video = {
                            frameRate: {
                                ideal: e.attributes.mxaFr,
                                max: e.attributes.mxaFr
                            },
                            height: {
                                ideal: e.attributes.height
                            },
                            width: {
                                ideal: e.attributes.width
                            },
                            mediaSource: e.mediaSource
                        }, navigator.getMedia(n, t, i)
                    } else if (null !== window.navigator.userAgent.match("Chrome")) {
                        if (window.navigator.appVersion.match(/Chrome\/([\w\W]*?)\./)[1] < 34) return void i({
                            code: "This browser does not support screen sharing"
                        });
                        var o = "okeephmleflklcdebijnponpabbmmgeo";
                        e.extensionId && (le.debug("extensionId supplied, using " + e.extensionId), o = e.extensionId), le.debug("Screen access on chrome stable, looking for extension");
                        try {
                            chrome.runtime.sendMessage(o, {
                                getStream: !0
                            }, function(o) {
                                if (void 0 !== o) {
                                    var r = o.streamId,
                                        a = e.attributes.width,
                                        s = e.attributes.height,
                                        d = e.attributes.maxFr,
                                        c = e.attributes.minFr;
                                    n = {
                                        video: {
                                            mandatory: {
                                                chromeMediaSource: "desktop",
                                                chromeMediaSourceId: r,
                                                maxHeight: s,
                                                maxWidth: a,
                                                maxFrameRate: d,
                                                minFrameRate: c
                                            }
                                        }
                                    }, navigator.getMedia(n, t, i)
                                } else {
                                    le.error("No response from Chrome Plugin. Plugin not installed properly");
                                    i({
                                        name: "PluginNotInstalledProperly",
                                        message: "No response from Chrome Plugin. Plugin not installed properly."
                                    })
                                }
                            })
                        } catch (e) {
                            le.debug("AgoraRTC screensharing plugin is not accessible");
                            return void i({
                                code: "no_plugin_present"
                            })
                        }
                    } else le.debug("This browser does not support screenSharing")
                } else window.navigator.userAgent.indexOf("Safari") > -1 && -1 === navigator.userAgent.indexOf("Chrome") ? navigator.mediaDevices.getUserMedia(e).then(t).catch(i) : "undefined" != typeof navigator && navigator.getMedia ? navigator.getMedia(e, t, i) : le.error("Video/audio streams not supported yet")
            },
            We = function(e, t, i) {
                if (["End2EndDelay", "TransportDelay", "PacketLossRate", "RecvLevel", "RecvBitrate", "CodecType", "MuteState", "TotalFreezeTime", "TotalPlayDuration", "RecordingLevel", "SendLevel", "SamplingRate", "SendBitrate", "CodecType", "MuteState", "End2EndDelay", "TransportDelay", "PacketLossRate", "RecvBitrate", "RecvResolutionWidth", "RecvResolutionHeight", "RenderResolutionHeight", "RenderResolutionWidth", "RenderFrameRate", "TotalFreezeTime", "TotalPlayDuration", "TargetSendBitrate", "SendFrameRate", "SendFrameRate", "SendBitrate", "SendResolutionWidth", "SendResolutionHeight", "CaptureResolutionHeight", "CaptureResolutionWidth", "EncodeDelay", "MuteState", "TotalFreezeTime", "TotalDuration", "CaptureFrameRate", "RTT", "OutgoingAvailableBandwidth", "Duration", "UserCount", "SendBytes", "RecvBytes", "SendBitrate", "RecvBitrate", "accessDelay", "audioSendBytes", "audioSendPackets", "videoSendBytes", "videoSendPackets", "videoSendPacketsLost", "videoSendFrameRate", "audioSendPacketsLost", "videoSendResolutionWidth", "videoSendResolutionHeight", "accessDelay", "audioReceiveBytes", "audioReceivePackets", "audioReceivePacketsLost", "videoReceiveBytes", "videoReceivePackets", "videoReceivePacketsLost", "videoReceiveFrameRate", "videoReceiveDecodeFrameRate", "videoReceiveResolutionWidth", "videoReceiveResolutionHeight", "endToEndDelay", "videoReceiveDelay", "audioReceiveDelay", "FirstFrameTime", "VideoFreezeRate", "AudioFreezeRate", "RenderResolutionWidth", "RenderResolutionHeight"].indexOf(t) > -1 && ("string" == typeof i || isFinite(i))) return e[t] = "" + i
            },
            je = new function() {
                var e = pe();
                return e.devicesHistory = {}, e.states = {
                    UNINIT: "UNINIT",
                    INITING: "INITING",
                    INITED: "INITED"
                }, e.state = e.states.UNINIT, e.deviceStates = {
                    ACTIVE: "ACTIVE",
                    INACTIVE: "INACTIVE"
                }, e.deviceReloadTimer = null, e._init = function(t, i) {
                    e.state = e.states.INITING, e.devicesHistory = {}, e._reloadDevicesInfo(function() {
                        e.state = e.states.INITED, e.dispatchEvent({
                            type: "inited"
                        }), t && t()
                    }, function(t) {
                        le.warning("Device Detection functionality cannot start properly."), e.state = e.states.UNINIT, i && i(t)
                    })
                }, e._enumerateDevices = function(e, t) {
                    if (!navigator.mediaDevices || !navigator.mediaDevices.enumerateDevices) return le.warning("enumerateDevices() not supported."), t && t("enumerateDevices() not supported");
                    navigator.mediaDevices.enumerateDevices().then(function(t) {
                        e && setTimeout(function() {
                            e(t)
                        }, 0)
                    }).catch(function(e) {
                        t && t(e)
                    })
                }, e._reloadDevicesInfo = function(t, i) {
                    var n = [];
                    e._enumerateDevices(function(i) {
                        var o = Date.now();
                        for (var r in i.forEach(function(t) {
                                var i = e.devicesHistory[t.deviceId];
                                if ((i ? i.state : e.deviceStates.INACTIVE) != e.deviceStates.ACTIVE) {
                                    var r = i || {
                                        initAt: o
                                    };
                                    r.device = t, r.state = e.deviceStates.ACTIVE, n.push(r), e.devicesHistory[t.deviceId] = r
                                }
                                e.devicesHistory[t.deviceId].lastReloadAt = o
                            }), e.devicesHistory) {
                            var a = e.devicesHistory[r];
                            a && a.state == e.deviceStates.ACTIVE && a.lastReloadAt !== o && (a.state = e.deviceStates.INACTIVE, n.push(a)), a.lastReloadAt = o
                        }
                        e.state == e.states.INITED && n.forEach(function(t) {
                            var i = Z()({}, t);
                            switch (t.device.kind) {
                                case "audioinput":
                                    i.type = "recordingDeviceChanged";
                                    break;
                                case "audiooutput":
                                    i.type = "playoutDeviceChanged";
                                    break;
                                case "videoinput":
                                    i.type = "cameraChanged";
                                    break;
                                default:
                                    le.warning("Unknown device change", i), i.type = "unknownDeviceChanged"
                            }
                            e.dispatchEvent(i)
                        }), t && t()
                    }, i)
                }, e.getDeviceById = function(t, i, n) {
                    e.getDevices(function(e) {
                        for (var o = 0; o < e.length; o++) {
                            var r = e[o];
                            if (r && r.deviceId === t) return i && i(r)
                        }
                        return n && n()
                    })
                }, e.searchDeviceNameById = function(t) {
                    var i = e.devicesHistory[t];
                    return i ? i.device.label || i.device.deviceId : null
                }, e.getDevices = function(t, i) {
                    e._enumerateDevices(t, function(e) {
                        i && i(e.name + ": " + e.message)
                    })
                }, e.getVideoCameraIdByLabel = function(t, i, n) {
                    e.getCameras(function(e) {
                        var o = !0,
                            r = !1,
                            a = void 0;
                        try {
                            for (var s, d = e[Symbol.iterator](); !(o = (s = d.next()).done); o = !0) {
                                var c = s.value;
                                if (c.label === t) return i && i(c.deviceId)
                            }
                        } catch (e) {
                            r = !0, a = e
                        } finally {
                            try {
                                o || null == d.return || d.return()
                            } finally {
                                if (r) throw a
                            }
                        }
                        return n && n(be.NOT_FIND_DEVICE_BY_LABEL)
                    }, n)
                }, e.getRecordingDevices = function(t, i) {
                    return e._enumerateDevices(function(e) {
                        var i = e.filter(function(e) {
                            return "audioinput" == e.kind
                        });
                        t && t(i)
                    }, function(e) {
                        i && i(e)
                    })
                }, e.getPlayoutDevices = function(t, i) {
                    return e._enumerateDevices(function(e) {
                        var i = e.filter(function(e) {
                            return "audiooutput" == e.kind
                        });
                        t && t(i)
                    }, function(e) {
                        i && i(e)
                    })
                }, e.getCameras = function(t, i) {
                    return e._enumerateDevices(function(e) {
                        var i = e.filter(function(e) {
                            return "videoinput" == e.kind
                        });
                        t && t(i)
                    }, function(e) {
                        i && i(e)
                    })
                }, e._init(function() {
                    navigator.mediaDevices && navigator.mediaDevices.addEventListener && navigator.mediaDevices.addEventListener("devicechange", function() {
                        e._reloadDevicesInfo()
                    }), e.deviceReloadTimer = setInterval(e._reloadDevicesInfo, 5e3)
                }), e
            },
            He = function(e, t, i) {
                for (var n = 0; n < i.length; n++)
                    if (e === i[n]) return !0;
                throw new Error("".concat(t, " can only be set as ").concat(JSON.stringify(i)))
            },
            Ge = function(e, t) {
                if (!e) throw new Error("Invalid param: ".concat(t || "param", " cannot be empty"));
                if ("object" !== c()(e)) throw new Error("".concat(t || "This paramter", " is of the object type"));
                return !0
            },
            ze = function(e, t, i, n) {
                if (tt(i) && (i = 1), n = n || 255, tt(e)) throw new Error("".concat(t || "param", " cannot be empty"));
                if (!Ye(e, i, n)) throw new Error("Invalid ".concat(t || "string param", ": Length of the string: [").concat(i, ",").concat(n, "]. ASCII characters only."))
            },
            Je = function(e, t, i, n) {
                if (tt(i) && (i = 1), n = n || 1e4, tt(e)) throw new Error("".concat(t || "param", " cannot be empty"));
                if (!qe(e, i, n)) throw new Error("Invalid ".concat(t || "number param", ": The value range is [").concat(i, ",").concat(n, "]. integer only"))
            },
            Ke = function(e, t) {
                if (tt(e)) throw new Error("".concat(t || "param", " cannot be empty"));
                if (!Qe(e)) throw new Error("Invalid ".concat(t || "boolean param", ": The value is of the boolean type."))
            },
            Ye = function(e, t, i) {
                return t || (t = 0), i || (i = Number.MAX_SAFE_INTEGER), et(e) && $e(e) && e.length >= t && e.length <= i
            },
            qe = function(e, t, i) {
                return Ze(e) && e >= t && e <= i
            },
            Qe = function(e) {
                return "boolean" == typeof e
            },
            Xe = function(e) {
                return Ye(e, 1, 2047)
            },
            $e = function(e) {
                if ("string" == typeof e) {
                    for (var t = 0; t < e.length; t++) {
                        var i = e.charCodeAt(t);
                        if (i < 0 || i > 255) return !1
                    }
                    return !0
                }
            },
            Ze = function(e) {
                return "number" == typeof e && e % 1 == 0
            },
            et = function(e) {
                return "string" == typeof e
            },
            tt = function(e) {
                return null === e || void 0 === e
            },
            it = function(e) {
                var t = pe();
                if (t.params = Z()({}, e), t.stream = e.stream, t.url = e.url, t.onClose = void 0, t.local = !1, t.videoSource = e.videoSource, t.audioSource = e.audioSource, t.video = !!e.video, t.audio = !!e.audio, t.screen = !!e.screen, t.screenAttributes = {
                        width: 1920,
                        height: 1080,
                        maxFr: 5,
                        minFr: 1
                    }, t.videoSize = e.videoSize, t.player = void 0, t.audioLevelHelper = null, e.attributes = e.attributes || {}, t.attributes = e.attributes, t.microphoneId = e.microphoneId, t.cameraId = e.cameraId, t.inSwitchDevice = !1, t.videoEnabled = !0, t.audioEnabled = !0, t.lowStream = null, t.videoWidth = 0, t.videoHeight = 0, t.streamId = null, t.streamId = e.streamID, t.userId = null, t.mirror = !1 !== e.mirror, t.DTX = e.audioProcessing && e.audioProcessing.DTX, t.audioProcessing = e.audioProcessing, t.highQuality = !1, t.stereo = !1, t.speech = !1, t.audioMixing = {
                        state: "UNINIT",
                        muted: !0,
                        states: {
                            UNINIT: "UNINIT",
                            IDLE: "IDLE",
                            STARTING: "STARTING",
                            BUSY: "BUSY",
                            PAUSED: "PAUSED"
                        },
                        inEarMonitoring: "FILE",
                        inEarMonitoringModes: {
                            NONE: "NONE",
                            FILE: "FILE",
                            MICROPHONE: "MOCROPHONE",
                            ALL: "ALL"
                        },
                        volume: 100,
                        startAt: null,
                        startOffset: null,
                        pauseAt: null,
                        pauseOffset: null,
                        resumeAt: null,
                        resumeOffset: null,
                        stopAt: null,
                        ctx: null,
                        mediaStreamSource: null,
                        mediaStreamDest: null,
                        options: null,
                        buffer: {},
                        source: []
                    }, t.screen || delete t.screen, !(void 0 === t.videoSize || t.videoSize instanceof Array && 4 === t.videoSize.length)) throw Error("Invalid Video Size");

                function i(e, t) {
                    return {
                        width: {
                            ideal: e
                        },
                        height: {
                            ideal: t
                        }
                    }
                }
                t.videoSize = [640, 480, 640, 480], void 0 !== e.local && !0 !== e.local || (t.local = !0), t.initialized = !t.local, t.on("collectStats", function(e) {
                    e.promises.push(t._getPCStats()), e.promises.push(new Promise(function(e) {
                        var i = {};
                        t.pc && t.pc.isSubscriber ? null !== window.navigator.userAgent.match("Firefox") && (We(i, "videoReceiveResolutionHeight", t.videoHeight), We(i, "videoReceiveResolutionWidth", t.videoWidth)) : t.pc && !t.pc.isSubscriber && ((l() || p()) && (We(i, "videoSendResolutionHeight", t.videoHeight), We(i, "videoSendResolutionWidth", t.videoWidth)), (l() || p()) && t.uplinkStats && We(i, "videoSendPacketsLost", t.uplinkStats.uplink_cumulative_lost)), e(i)
                    })), e.promises.push(new Promise(function(e) {
                        var i = {};
                        return t.traffic_stats && t.pc && t.pc.isSubscriber ? (We(i, "accessDelay", t.traffic_stats.access_delay), We(i, "endToEndDelay", t.traffic_stats.e2e_delay), We(i, "videoReceiveDelay", t.traffic_stats.video_delay), We(i, "audioReceiveDelay", t.traffic_stats.audio_delay)) : t.traffic_stats && t.pc && !t.pc.isSubscriber && We(i, "accessDelay", t.traffic_stats.access_delay), e(i)
                    }))
                });
                var n = {
                    true: !0,
                    unspecified: !0,
                    "90p_1": i(160, 90),
                    "120p_1": i(160, 120),
                    "120p_3": i(120, 120),
                    "120p_4": i(212, 120),
                    "180p_1": i(320, 180),
                    "180p_3": i(180, 180),
                    "180p_4": i(240, 180),
                    "240p_1": i(320, 240),
                    "240p_3": i(240, 240),
                    "240p_4": i(424, 240),
                    "360p_1": i(640, 360),
                    "360p_3": i(360, 360),
                    "360p_4": i(640, 360),
                    "360p_6": i(360, 360),
                    "360p_7": i(480, 360),
                    "360p_8": i(480, 360),
                    "360p_9": i(640, 360),
                    "360p_10": i(640, 360),
                    "360p_11": i(640, 360),
                    "480p_1": i(640, 480),
                    "480p_2": i(640, 480),
                    "480p_3": i(480, 480),
                    "480p_4": i(640, 480),
                    "480p_6": i(480, 480),
                    "480p_8": i(848, 480),
                    "480p_9": i(848, 480),
                    "480p_10": i(640, 480),
                    "720p_1": i(1280, 720),
                    "720p_2": i(1280, 720),
                    "720p_3": i(1280, 720),
                    "720p_5": i(960, 720),
                    "720p_6": i(960, 720),
                    "1080p_1": i(1920, 1080),
                    "1080p_2": i(1920, 1080),
                    "1080p_3": i(1920, 1080),
                    "1080p_5": i(1920, 1080),
                    "1440p_1": i(2560, 1440),
                    "1440p_2": i(2560, 1440),
                    "4k_1": i(3840, 2160),
                    "4k_3": i(3840, 2160)
                };
                return t.setVideoResolution = function(t) {
                    return void 0 !== n[t += ""] && (e.video = n[t], e.attributes = e.attributes || {}, e.attributes.resolution = t, !0)
                }, t.setVideoFrameRate = function(t) {
                    return !p() && ("object" === c()(t) && t instanceof Array && t.length > 1 && (e.attributes = e.attributes || {}, e.attributes.minFrameRate = t[0], e.attributes.maxFrameRate = t[1], !0))
                }, t.setVideoBitRate = function(t) {
                    return "object" === c()(t) && t instanceof Array && t.length > 1 && (e.attributes = e.attributes || {}, e.attributes.minVideoBW = t[0], e.attributes.maxVideoBW = t[1], !0)
                }, t.setScreenBitRate = function(t) {
                    return "object" === c()(t) && t instanceof Array && t.length > 1 && (e.screenAttributes = e.screenAttributes || {}, e.screenAttributes.minVideoBW = t[0], e.screenAttributes.maxVideoBW = t[1], !0)
                }, t.setScreenProfile = function(e) {
                    if (He(e, "profile", ["480p_1", "480p_2", "720p_1", "720p_2", "1080p_1", "1080p_2"]), "string" == typeof e && t.screen) {
                        switch (e) {
                            case "480p_1":
                                t.screenAttributes.width = 640, t.screenAttributes.height = 480, t.screenAttributes.maxFr = 5, t.screenAttributes.minFr = 1;
                                break;
                            case "480p_2":
                                t.screenAttributes.width = 640, t.screenAttributes.height = 480, t.screenAttributes.maxFr = 30, t.screenAttributes.minFr = 25;
                                break;
                            case "720p_1":
                                t.screenAttributes.width = 1280, t.screenAttributes.height = 720, t.screenAttributes.maxFr = 5, t.screenAttributes.minFr = 1;
                                break;
                            case "720p_2":
                                t.screenAttributes.width = 1280, t.screenAttributes.height = 720, t.screenAttributes.maxFr = 30, t.screenAttributes.minFr = 25;
                                break;
                            case "1080p_1":
                                t.screenAttributes.width = 1920, t.screenAttributes.height = 1080, t.screenAttributes.maxFr = 5, t.screenAttributes.minFr = 1;
                                break;
                            case "1080p_2":
                                t.screenAttributes.width = 1920, t.screenAttributes.height = 1080, t.screenAttributes.maxFr = 30, t.screenAttributes.minFr = 25
                        }
                        return !0
                    }
                    return !1
                }, t.setVideoProfileCustom = function(e) {
                    t.setVideoResolution(e[0]), t.setVideoFrameRate([e[1], e[1]]), t.setVideoBitRate([e[2], e[2]])
                }, t.setVideoProfileCustomPlus = function(n) {
                    console.log(n), e.video = i(n.width, n.height), e.attributes = e.attributes || {}, e.attributes.resolution = "".concat(n.width, "x").concat(n.height), t.setVideoFrameRate([n.framerate, n.framerate]), t.setVideoBitRate([n.bitrate, n.bitrate])
                }, t.setVideoProfile = function(e) {
                    if (He(e, "profile", ["480p_1", "480p_2", "720p_1", "720p_2", "1080p_1", "1080p_2", "120p", "120P", "120p_1", "120P_1", "120p_3", "120P_3", "180p", "180P", "180p_1", "180P_1", "180p_3", "180P_3", "180p_4", "180P_4", "240p", "240P", "240p_1", "240P_1", "240p_3", "240P_3", "240p_4", "240P_4", "360p", "360P", "360p_1", "360P_1", "360p_3", "360P_3", "360p_4", "360P_4", "360p_6", "360P_6", "360p_7", "360P_7", "360p_8", "360P_8", "360p_9", "360P_9", "360p_10", "360P_10", "360p_11", "360P_11", "480p", "480P", "480p_1", "480P_1", "480p_2", "480P_2", "480p_3", "480P_3", "480p_4", "480P_4", "480p_6", "480P_6", "480p_8", "480P_8", "480p_9", "480P_9", "480p_10", "480P_10", "720p", "720P", "720p_1", "720P_1", "720p_2", "720P_2", "720p_3", "720P_3", "720p_5", "720P_5", "720p_6", "720P_6", "1080p", "1080P", "1080p_1", "1080P_1", "1080p_2", "1080P_2", "1080p_3", "1080P_3", "1080p_5", "1080P_5", "1440p", "1440P", "1440p_1", "1440P_1", "1440p_2", "1440P_2", "4k", "4K", "4k_1", "4K_1", "4k_3", "4K_3"]), t.profile = e, "string" == typeof e && t.video) {
                        switch (e) {
                            case "120p":
                            case "120P":
                            case "120p_1":
                            case "120P_1":
                                t.setVideoResolution("120p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([30, 65]);
                                break;
                            case "120p_3":
                            case "120P_3":
                                t.setVideoResolution("120p_3"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([30, 50]);
                                break;
                            case "180p":
                            case "180P":
                            case "180p_1":
                            case "180P_1":
                                t.setVideoResolution("180p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([30, 140]);
                                break;
                            case "180p_3":
                            case "180P_3":
                                t.setVideoResolution("180p_3"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([30, 100]);
                                break;
                            case "180p_4":
                            case "180P_4":
                                t.setVideoResolution("180p_4"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([30, 120]);
                                break;
                            case "240p":
                            case "240P":
                            case "240p_1":
                            case "240P_1":
                                t.setVideoResolution("240p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([40, 200]);
                                break;
                            case "240p_3":
                            case "240P_3":
                                t.setVideoResolution("240p_3"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([40, 140]);
                                break;
                            case "240p_4":
                            case "240P_4":
                                t.setVideoResolution("240p_4"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([40, 220]);
                                break;
                            case "360p":
                            case "360P":
                            case "360p_1":
                            case "360P_1":
                                t.setVideoResolution("360p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([80, 400]);
                                break;
                            case "360p_3":
                            case "360P_3":
                                t.setVideoResolution("360p_3"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([80, 260]);
                                break;
                            case "360p_4":
                            case "360P_4":
                                t.setVideoResolution("360p_4"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([80, 600]);
                                break;
                            case "360p_6":
                            case "360P_6":
                                t.setVideoResolution("360p_6"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([80, 400]);
                                break;
                            case "360p_7":
                            case "360P_7":
                                t.setVideoResolution("360p_7"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([80, 320]);
                                break;
                            case "360p_8":
                            case "360P_8":
                                t.setVideoResolution("360p_8"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([80, 490]);
                                break;
                            case "360p_9":
                            case "360P_9":
                                t.setVideoResolution("360p_9"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([80, 800]);
                                break;
                            case "360p_10":
                            case "360P_10":
                                t.setVideoResolution("360p_10"), t.setVideoFrameRate([24, 24]), t.setVideoBitRate([80, 800]);
                                break;
                            case "360p_11":
                            case "360P_11":
                                t.setVideoResolution("360p_11"), t.setVideoFrameRate([24, 24]), t.setVideoBitRate([80, 1e3]);
                                break;
                            case "480p":
                            case "480P":
                            case "480p_1":
                            case "480P_1":
                                t.setVideoResolution("480p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([20, 500]);
                                break;
                            case "480p_2":
                            case "480P_2":
                                t.setVideoResolution("480p_2"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([100, 1e3]);
                                break;
                            case "480p_3":
                            case "480P_3":
                                t.setVideoResolution("480p_3"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([100, 400]);
                                break;
                            case "480p_4":
                            case "480P_4":
                                t.setVideoResolution("480p_4"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([100, 750]);
                                break;
                            case "480p_6":
                            case "480P_6":
                                t.setVideoResolution("480p_6"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([100, 600]);
                                break;
                            case "480p_8":
                            case "480P_8":
                                t.setVideoResolution("480p_8"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([100, 610]);
                                break;
                            case "480p_9":
                            case "480P_9":
                                t.setVideoResolution("480p_9"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([100, 930]);
                                break;
                            case "480p_10":
                            case "480P_10":
                                t.setVideoResolution("480p_10"), t.setVideoFrameRate([10, 10]), t.setVideoBitRate([100, 400]);
                                break;
                            case "720p":
                            case "720P":
                            case "720p_1":
                            case "720P_1":
                                t.setVideoResolution("720p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([120, 1130]);
                                break;
                            case "720p_2":
                            case "720P_2":
                                t.setVideoResolution("720p_2"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 2e3]);
                                break;
                            case "720p_3":
                            case "720P_3":
                                t.setVideoResolution("720p_3"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 1710]);
                                break;
                            case "720p_5":
                            case "720P_5":
                                t.setVideoResolution("720p_5"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([120, 910]);
                                break;
                            case "720p_6":
                            case "720P_6":
                                t.setVideoResolution("720p_6"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 1380]);
                                break;
                            case "1080p":
                            case "1080P":
                            case "1080p_1":
                            case "1080P_1":
                                t.setVideoResolution("1080p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([120, 2080]);
                                break;
                            case "1080p_2":
                            case "1080P_2":
                                t.setVideoResolution("1080p_2"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 3e3]);
                                break;
                            case "1080p_3":
                            case "1080P_3":
                                t.setVideoResolution("1080p_3"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 3150]);
                                break;
                            case "1080p_5":
                            case "1080P_5":
                                t.setVideoResolution("1080p_5"), t.setVideoFrameRate([60, 60]), t.setVideoBitRate([120, 4780]);
                                break;
                            case "1440p":
                            case "1440P":
                            case "1440p_1":
                            case "1440P_1":
                                t.setVideoResolution("1440p_1"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 4850]);
                                break;
                            case "1440p_2":
                            case "1440P_2":
                                t.setVideoResolution("1440p_2"), t.setVideoFrameRate([60, 60]), t.setVideoBitRate([120, 7350]);
                                break;
                            case "4k":
                            case "4K":
                            case "4k_1":
                            case "4K_1":
                                t.setVideoResolution("4k_1"), t.setVideoFrameRate([30, 30]), t.setVideoBitRate([120, 8910]);
                                break;
                            case "4k_3":
                            case "4K_3":
                                t.setVideoResolution("4k_3"), t.setVideoFrameRate([60, 60]), t.setVideoBitRate([120, 13500]);
                                break;
                            default:
                                t.setVideoResolution("480p_1"), t.setVideoFrameRate([15, 15]), t.setVideoBitRate([100, 500])
                        }
                        return !0
                    }
                    return !1
                }, t.setAudioProfile = function(e) {
                    if (He(e, "profile", ["speech_low_quality", "speech_standard", "music_standard", "standard_stereo", "high_quality", "high_quality_stereo"]), t.audioProfile = e, "string" == typeof e && t.audio) {
                        switch (e) {
                            case "speech_low_quality":
                                t.highQuality = !1, t.stereo = !1, t.speech = !0, t.lowQuality = !0;
                                break;
                            case "speech_standard":
                                t.highQuality = !1, t.stereo = !1, t.speech = !0, t.lowQuality = !1;
                                break;
                            case "music_standard":
                                t.highQuality = !1, t.stereo = !1, t.speech = !1, t.lowQuality = !1;
                                break;
                            case "standard_stereo":
                                t.highQuality = !1, t.stereo = !0, t.speech = !1, t.lowQuality = !1;
                                break;
                            case "high_quality":
                                t.highQuality = !0, t.stereo = !1, t.speech = !1, t.lowQuality = !1;
                                break;
                            case "high_quality_stereo":
                                t.highQuality = !0, t.stereo = !0, t.speech = !1, t.lowQuality = !1;
                                break;
                            default:
                                t.highQuality = !1, t.stereo = !1, t.speech = !1, t.lowQuality = !1
                        }
                        return !0
                    }
                    return !1
                }, t.getId = function() {
                    return t.streamId
                }, t.getUserId = function() {
                    return t.userId
                }, t.setUserId = function(e) {
                    t.userId && le.warning("Stream.userId ".concat(t.userId, " => ").concat(e)), t.userId = e
                }, t.getAttributes = function() {
                    return e.screen ? t.screenAttributes : e.attributes
                }, t.hasAudio = function() {
                    return t.audio
                }, t.hasVideo = function() {
                    return t.video
                }, t.hasScreen = function() {
                    return t.screen
                }, t.isVideoOn = function() {
                    return (t.hasVideo() || t.hasScreen()) && t.videoEnabled
                }, t.isAudioOn = function() {
                    return t.hasAudio() && t.audioEnabled
                }, t.init = function(i, n) {
                    (new Date).getTime();
                    var o = arguments[2];
                    if (void 0 === o && (o = 2), !0 !== t.initialized)
                        if (!0 === t.local) {
                            if (t.videoSource ? t.videoName = "videoSource" : t.video && (t.videoName = je.searchDeviceNameById(e.cameraId) || "default"), t.audioSource ? t.audioName = "audioSource" : t.audio && (t.audioName = je.searchDeviceNameById(e.microphoneId) || "default"), t.screen && (t.screenName = e.extensionId || "default"), t.videoSource || t.audioSource) {
                                var r = new MediaStream;
                                return t.videoSource && (le.debug("Added videoSource"), r.addTrack(t.videoSource), t.video = !0), t.audioSource && (le.debug("Added audioSource"), r.addTrack(t.audioSource), t.audio = !0), t.hasVideo() ? U(r, function(e, n) {
                                    le.info("Video Source width ".concat(e, " height ").concat(n)), t.stream = r, t.initialized = !0, i && i()
                                }, function(e) {
                                    le.warning("Failed to get width & height from video source", e), t.stream = r, t.initialized = !0, i && i()
                                }) : (t.stream = r, t.initialized = !0, i && i())
                            }
                            try {
                                if ((e.audio || e.video || e.screen) && void 0 === e.url) {
                                    le.debug("Requested access to local media");
                                    var a = e.video;
                                    if (e.screen) var s = {
                                        video: a,
                                        audio: !1,
                                        screen: !0,
                                        data: !0,
                                        extensionId: e.extensionId,
                                        attributes: t.screenAttributes,
                                        fake: e.fake,
                                        mediaSource: e.mediaSource,
                                        sourceId: e.sourceId
                                    };
                                    else {
                                        s = {
                                            video: a,
                                            audio: e.audio,
                                            fake: e.fake
                                        };
                                        if (!(null !== window.navigator.appVersion.match(/Chrome\/([\w\W]*?)\./) && window.navigator.appVersion.match(/Chrome\/([\w\W]*?)\./)[1] <= 35)) {
                                            var d = 30,
                                                l = 30;
                                            if (void 0 !== e.attributes.minFrameRate && (d = e.attributes.minFrameRate), void 0 !== e.attributes.maxFrameRate && (l = e.attributes.maxFrameRate), !0 === s.audio) {
                                                s.audio = !e.microphoneId || {
                                                    deviceId: {
                                                        exact: e.microphoneId
                                                    }
                                                };
                                                var g = {};
                                                t.audioProcessing && (void 0 !== t.audioProcessing.AGC && (p() ? g.autoGainControl = t.audioProcessing.AGC : u() && (g.googAutoGainControl = t.audioProcessing.AGC, g.googAutoGainControl2 = t.audioProcessing.AGC)), void 0 !== t.audioProcessing.AEC && (g.echoCancellation = t.audioProcessing.AEC), void 0 !== t.audioProcessing.ANS && (p() ? g.noiseSuppression = t.audioProcessing.ANS : u() && (g.googNoiseSuppression = t.audioProcessing.ANS))), t.stereo && u() && (g.googAutoGainControl = !1, g.googAutoGainControl2 = !1, g.echoCancellation = !1, g.googNoiseSuppression = !1), 0 !== Object.keys(g).length && (!0 === s.audio ? s.audio = {
                                                    mandatory: g
                                                } : s.audio = Z()(s.audio, g))
                                            }!0 === s.video ? (s.video = {
                                                width: {
                                                    ideal: t.videoSize[0]
                                                },
                                                height: {
                                                    ideal: t.videoSize[1]
                                                },
                                                frameRate: {
                                                    ideal: d,
                                                    max: l
                                                }
                                            }, t.setVideoBitRate([500, 500]), s.video.deviceId = e.cameraId ? {
                                                exact: e.cameraId
                                            } : void 0) : "object" === c()(s.video) && (s.video.frameRate = {
                                                ideal: d,
                                                max: l
                                            }, s.video.deviceId = e.cameraId ? {
                                                exact: e.cameraId
                                            } : void 0)
                                        }
                                    }
                                    le.debug(s);
                                    var m = Z()({}, s);
                                    if (t.constraints = s, Ue(m, function(o) {
                                            t.screenAudioTrack && o.addTrack(t.screenAudioTrack);
                                            var r = o.getVideoTracks().length > 0,
                                                a = o.getAudioTracks().length > 0;
                                            return m.video && !r && m.audio && !a ? (le.error("Media access: NO_CAMERA_MIC_PERMISSION"), n && n("NO_CAMERA_MIC_PERMISSION")) : m.video && !r ? (le.error("Media access: NO_CAMERA_PERMISSION"), n && n("NO_CAMERA_PERMISSION")) : m.screen && !r ? (le.error("Media access: NO_SCREEN_PERMISSION"), n && n("NO_SCREEN_PERMISSION")) : m.audio && !a ? (le.error("Media access: NO_MIC_PERMISSION"), n && n("NO_MIC_PERMISSION")) : (le.debug("User has granted access to local media"), t.dispatchEvent({
                                                type: "accessAllowed"
                                            }), t.stream = o, t.initialized = !0, e.video || e.screen || e.videoSource ? t.videoEnabled = !0 : t.videoEnabled = !1, e.audio || e.audioSource ? t.audioEnabled = !0 : t.audioEnabled = !1, e.screen && e.audio && !t.screenAudioTrack || i && i(), t.hasVideo() && U(o, function(e, i) {
                                                t.videoWidth = e, t.videoHeight = i
                                            }, function(e) {
                                                le.warning("vsResHack failed:" + e)
                                            }), void(e.screen && u() && t.stream && t.stream.getVideoTracks()[0] && (t.stream.getVideoTracks()[0].onended = function() {
                                                t.dispatchEvent({
                                                    type: "stopScreenSharing"
                                                })
                                            })))
                                        }, function(e) {
                                            var r = {
                                                type: "error",
                                                msg: e.name || e.code || e,
                                                info: null
                                            };
                                            switch (e && (e.message && (r.info = e.message), e.code && (r.info ? r.info += ". " + e.code : r.info = " " + e.code), e.constraint && (r.info ? r.info += ". Constraint: " + e.constraint : r.info = "constraint: " + e.constraint)), r.msg) {
                                                case "Starting video failed":
                                                case "TrackStartError":
                                                    if (t.videoSize = void 0, o > 0) return void setTimeout(function() {
                                                        t.init(i, n, o - 1)
                                                    }, 1);
                                                    r.msg = "MEDIA_OPTION_INVALID";
                                                    break;
                                                case "DevicesNotFoundError":
                                                    r.msg = "DEVICES_NOT_FOUND";
                                                    break;
                                                case "NotSupportedError":
                                                    r.msg = "NOT_SUPPORTED";
                                                    break;
                                                case "PermissionDeniedError":
                                                    r.msg = "PERMISSION_DENIED", t.dispatchEvent({
                                                        type: "accessDenied"
                                                    });
                                                    break;
                                                case "PERMISSION_DENIED":
                                                    t.dispatchEvent({
                                                        type: "accessDenied"
                                                    });
                                                    break;
                                                case "InvalidStateError":
                                                    r.msg = "PERMISSION_DENIED", t.dispatchEvent({
                                                        type: "accessDenied"
                                                    });
                                                    break;
                                                case "NotAllowedError":
                                                    t.dispatchEvent({
                                                        type: "accessDenied"
                                                    });
                                                    break;
                                                case "ConstraintNotSatisfiedError":
                                                    r.msg = "CONSTRAINT_NOT_SATISFIED";
                                                    break;
                                                default:
                                                    r.msg || (r.msg = "UNDEFINED")
                                            }
                                            var a = "Media access ".concat(r.msg).concat(r.info ? ": " + r.info : "");
                                            if (le.error(a), "function" == typeof n) return n(r)
                                        }), e.screen && e.audio) {
                                        var f = !e.microphoneId || {
                                            deviceId: {
                                                exact: e.microphoneId
                                            }
                                        };
                                        g = {};
                                        t.audioProcessing && (void 0 !== t.audioProcessing.AGC && (p() ? g.autoGainControl = t.audioProcessing.AGC : u() && (g.googAutoGainControl = t.audioProcessing.AGC, g.googAutoGainControl2 = t.audioProcessing.AGC)), void 0 !== t.audioProcessing.AEC && (g.echoCancellation = t.audioProcessing.AEC), void 0 !== t.audioProcessing.ANS && (p() ? g.noiseSuppression = t.audioProcessing.ANS : u() && (g.googNoiseSuppression = t.audioProcessing.ANS))), t.stereo && u() && (g.googAutoGainControl = !1, g.googAutoGainControl2 = !1, g.echoCancellation = !1, g.googNoiseSuppression = !1), 0 !== Object.keys(g).length && (f = !0 === f ? {
                                            mandatory: g
                                        } : Z()(f, g));
                                        var v = {
                                            video: !1,
                                            audio: f
                                        };
                                        le.debug(v), Ue(v, function(e) {
                                            le.info("User has granted access to auxiliary local media."), t.dispatchEvent({
                                                type: "accessAllowed"
                                            });
                                            var n = e.getAudioTracks()[0];
                                            t.stream ? (t.stream.addTrack(n), i && i()) : t.screenAudioTrack = n
                                        }, function(e) {
                                            var r = {
                                                type: "error",
                                                msg: e.name || e.code || e,
                                                info: null
                                            };
                                            switch (e && (e.message && (r.info = e.message), e.code && (r.info ? r.info += ". " + e.code : r.info = " " + e.code), e.constraint && (r.info ? r.info += ". Constraint: " + e.constraint : r.info = "constraint: " + e.constraint)), r.msg) {
                                                case "Starting video failed":
                                                case "TrackStartError":
                                                    if (t.videoSize = void 0, o > 0) return void setTimeout(function() {
                                                        t.init(i, n, o - 1)
                                                    }, 1);
                                                    r.msg = "MEDIA_OPTION_INVALID";
                                                    break;
                                                case "DevicesNotFoundError":
                                                    r.msg = "DEVICES_NOT_FOUND";
                                                    break;
                                                case "NotSupportedError":
                                                    r.msg = "NOT_SUPPORTED";
                                                    break;
                                                case "PermissionDeniedError":
                                                case "InvalidStateError":
                                                    r.msg = "PERMISSION_DENIED", t.dispatchEvent({
                                                        type: "accessDenied"
                                                    });
                                                    break;
                                                case "PERMISSION_DENIED":
                                                case "NotAllowedError":
                                                    t.dispatchEvent({
                                                        type: "accessDenied"
                                                    });
                                                    break;
                                                case "ConstraintNotSatisfiedError":
                                                    r.msg = "CONSTRAINT_NOT_SATISFIED";
                                                    break;
                                                default:
                                                    r.msg || (r.msg = "UNDEFINED")
                                            }
                                            var a = "Media access ".concat(r.msg).concat(r.info ? ": " + r.info : "");
                                            le.error(a), "function" == typeof n && n(r)
                                        })
                                    }
                                } else "function" == typeof n && n({
                                    type: "warning",
                                    msg: "STREAM_HAS_NO_MEDIA_ATTRIBUTES"
                                })
                            } catch (e) {
                                le.error("Stream init:", e), "function" == typeof n && n({
                                    type: "error",
                                    msg: e.message || e
                                })
                            }
                        } else "function" == typeof n && n({
                            type: "warning",
                            msg: "STREAM_NOT_LOCAL"
                        });
                    else "function" == typeof n && n({
                        type: "warning",
                        msg: "STREAM_ALREADY_INITIALIZED"
                    })
                }, t.close = function() {
                    if (le.debug("Close stream with id", t.streamId), void 0 !== t.stream) {
                        var e = t.stream.getTracks();
                        for (var i in e) e.hasOwnProperty(i) && e[i].stop();
                        t.stream = void 0
                    }
                    l() && t.pc && t.pc.peerConnection && t.pc.peerConnection.removeTrack && t.pc.peerConnection.getSenders && t.pc.peerConnection.getSenders().forEach(function(e) {
                        e && (le.debug("Remove Track", e), t.pc.peerConnection.removeTrack(e))
                    });
                    t.initialized = !1, t._onAudioMute = void 0, t._onAudioUnmute = void 0, t._onVideoMute = void 0, t._onVideoUnmute = void 0, t.lowStream && t.lowStream.close()
                }, t.enableAudio = function() {
                    return le.deprecate("Stream.enableAudio is deprecated and will be removed in the future. Use Stream.unmuteAudio instead"), t._unmuteAudio()
                }, t.disableAudio = function() {
                    return le.deprecate("Stream.disableAudio is deprecated and will be removed in the future. Use Stream.muteAudio instead"), t._muteAudio()
                }, t.enableVideo = function() {
                    return le.deprecate("Stream.enableVideo is deprecated and will be removed in the future. Use Stream.unmuteVideo instead"), t._unmuteVideo()
                }, t.disableVideo = function() {
                    return le.deprecate("Stream.disableVideo is deprecated and will be removed in the future. Use Stream.muteVideo instead"), t._muteVideo()
                }, t.unmuteAudio = function() {
                    return t._unmuteAudio()
                }, t.muteAudio = function() {
                    return t._muteAudio()
                }, t.unmuteVideo = function() {
                    return t._unmuteVideo()
                }, t.muteVideo = function() {
                    return t._muteVideo()
                }, t._unmuteAudio = function() {
                    return le.debug("Unmuted audio stream with id", t.streamId), t._flushAudioMixingMuteStatus(!1), !(!t.hasAudio() || !t.initialized || void 0 === t.stream || !0 === t.stream.getAudioTracks()[0].enabled) && (t._onAudioUnmute && t._onAudioUnmute(), t.audioEnabled = !0, t.stream.getAudioTracks()[0].enabled = !0, !0)
                }, t._isAudioMuted = function() {
                    if (t.stream && t.hasAudio()) {
                        var e = t.stream.getAudioTracks();
                        return e.length > 0 && !e[0].enabled
                    }
                    return !1
                }, t._muteAudio = function() {
                    return le.debug("Muted audio stream with id", t.streamId), t._flushAudioMixingMuteStatus(!0), !!(t.hasAudio() && t.initialized && void 0 !== t.stream && t.stream.getAudioTracks()[0].enabled) && (t._onAudioMute && t._onAudioMute(), t.audioEnabled = !1, t.stream.getAudioTracks()[0].enabled = !1, t.sid && ne.audioSendingStopped(t.sid, {
                        succ: !0,
                        reason: "muteAudio"
                    }), !0)
                }, t._unmuteVideo = function() {
                    return le.debug("Unmuted video stream with id", t.streamId), !(!t.initialized || void 0 === t.stream || !t.stream.getVideoTracks().length || !0 === t.stream.getVideoTracks()[0].enabled) && (t._onVideoUnmute && t._onVideoUnmute(), t.pc && (t.pc.isVideoMute = !1), t.videoEnabled = !0, t.stream.getVideoTracks()[0].enabled = !0, t.lowStream && t.lowStream._unmuteVideo(), !0)
                }, t._muteVideo = function() {
                    return le.debug("Muted video stream with id", t.streamId), !!(t.initialized && void 0 !== t.stream && t.stream.getVideoTracks().length && t.stream.getVideoTracks()[0].enabled) && (t._onVideoMute && t._onVideoMute(), t.pc && (t.pc.isVideoMute = !0), t.videoEnabled = !1, t.stream.getVideoTracks()[0].enabled = !1, t.lowStream && t.lowStream._muteVideo(), t.sid && ne.videoSendingStopped(t.sid, {
                        succ: !0,
                        reason: "muteVideo"
                    }), !0)
                }, t.addTrack = function(e) {
                    if (t.pc && t.pc.addTrack(e, t.stream), "audio" == e.kind) {
                        var i = new MediaStream;
                        i.addTrack(e);
                        var n = t.stream.getVideoTracks()[0];
                        n && i.addTrack(n), t.stream = i, t.audioLevelHelper = null, t.player && t.player.video && (t.player.video.srcObject = t.stream)
                    } else t.stream.addTrack(e)
                }, t.removeTrack = function(e) {
                    t.pc && t.pc.removeTrack(e, t.stream), t.stream.removeTrack(e), t.audioLevelHelper = null, "live" == e.readyState && (e.stop(), le.debug("Track " + e.kind + " Stopped"))
                }, t.setAudioOutput = function(e, i, n) {
                    return Ye(e, 1, 255) ? (t.audioOutput = e, t.player ? void t.player.setAudioOutput(e, i, n) : i && i()) : (le.error("setAudioOutput Invalid Parameter", e), n && n(be.INVALID_PARAMETER))
                }, t.play = function(e, i) {
                    ze(e, "elementID"), tt(i) || (tt(i.fit) || He(i.fit, "fit", ["cover", "contain"]), tt(i.muted) || Ke(i.muted, "muted")), t.elementID = e, t.playOptions = i, t.isPlaying() ? le.error("Stream.play(): Stream is already playing") : !t.local || t.video || t.screen ? void 0 !== e && (t.player = new Ae({
                        id: t.getId(),
                        stream: t,
                        elementID: e,
                        options: i
                    })) : t.hasAudio() && (t.player = new Ae({
                        id: t.getId(),
                        stream: t,
                        elementID: e,
                        options: i
                    })), t.audioOutput && t.player.setAudioOutput(t.audioOutput), void 0 !== t.audioLevel && t.player.setAudioVolume(t.audioLevel), t._flushAudioMixingMuteStatus(!1)
                }, t.stop = function() {
                    le.debug("Stop stream player with id", t.streamId), t.player ? (t.player.destroy(), delete t.player) : le.error("Stream.stop(): Stream is not playing"), t._flushAudioMixingMuteStatus(!0)
                }, t.isPlaying = function() {
                    return !!t.player
                }, t.getVideoTrack = function() {
                    if (t.stream && t.stream.getVideoTracks) {
                        var e = t.stream.getVideoTracks()[0];
                        if (e) return le.info("getVideoTrack", e), e
                    }
                    le.info("getVideoTrack None")
                }, t.getAudioTrack = function() {
                    if (t.stream && t.stream.getAudioTracks) {
                        var e = t.stream.getAudioTracks()[0];
                        if (e) return le.info("getAudioTracks", e), e
                    }
                    le.info("getAudioTracks None")
                }, t._replaceMediaStreamTrack = function(e, i, n) {
                    if (t.stream) {
                        if ("video" == e.kind) {
                            if (r = t.stream.getVideoTracks()[0]) return t.stream.removeTrack(r), t.stream.addTrack(e), le.debug("_replaceMediaStreamTrack ".concat(e.kind, " SUCCESS")), "live" == r.readyState && (r.stop(), le.debug("Track " + r.kind + " Stopped")), i && i();
                            var o = "MEDIASTREAM_TRACK_NOT_FOUND";
                            return le.error("MEDIASTREAM_TRACK_NOT_FOUND ".concat(e.kind)), n(o)
                        }
                        if ("audio" == e.kind) {
                            var r;
                            if (r = t.stream.getAudioTracks()[0]) {
                                var a = new MediaStream;
                                a.addTrack(e);
                                var s = t.stream && t.stream.getVideoTracks()[0];
                                return s && a.addTrack(s), t.stream = a, t.audioLevelHelper = null, t.player && t.player.video && (t.player.video.srcObject = t.stream), le.debug("_replaceMediaStreamTrack SUCCESS"), "live" == r.readyState && (r.stop(), le.debug("Track " + r.kind + " Stopped")), i && i()
                            }
                            o = "MEDIASTREAM_TRACK_NOT_FOUND";
                            return le.error("MEDIASTREAM_TRACK_NOT_FOUND ".concat(e.kind)), n(o)
                        }
                        o = "INVALID_TRACK_TYPE";
                        return le.error("_replaceMediaStreamTrack ".concat(o, " ").concat(e.kind)), n && n(o)
                    }
                    o = "NO_STREAM_FOUND";
                    return le.error("_replaceMediaStreamTrack ".concat(o)), n && n(o)
                }, t.replaceTrack = function(e, i, n) {
                    return e && e.kind ? t.pc && t.pc.hasSender && t.pc.hasSender(e.kind) ? void t.pc.replaceTrack(e, function() {
                        return le.debug("PeerConnection.replaceTrack ".concat(e.kind, " SUCCESS")), t._replaceMediaStreamTrack(e, i, n)
                    }, function(t) {
                        return le.error("PeerConnection.replaceTrack ".concat(e.kind, " Failed ").concat(t)), n && n(t)
                    }) : t._replaceMediaStreamTrack(e, i, n) : n && n("INVALID_TRACK")
                }, t.setAudioVolume = function(e) {
                    Je(e, "level", 0, 100), t.audioLevel = e, t.player && t.player.setAudioVolume(e)
                }, t.getStats = function(e, i) {
                    var n = {
                        type: "collectStats",
                        promises: []
                    };
                    t.dispatchEvent(n), Promise.all(n.promises).then(function(i) {
                        for (var n = {}, o = i.length - 1; o >= 0; o--) {
                            var r = i[o];
                            Z()(n, r)
                        }
                        e && setTimeout(e.bind(t, n), 0)
                    }).catch(function(e) {
                        i && setTimeout(i.bind(t, e), 0)
                    })
                }, t._getPCStats = function() {
                    return new Promise(function(e, i) {
                        if (!t.pc || "established" !== t.pc.state || !t.pc.getStats) {
                            return i("PEER_CONNECTION_NOT_ESTABLISHED")
                        }
                        t.pc.getStats(function(n) {
                            if (!t.pc || "established" !== t.pc.state || !t.pc.getStats) {
                                return i("PEER_CONNECTION_STATE_CHANGE")
                            }
                            var o = t.pc.isSubscriber ? function(e) {
                                var t = {};
                                return e.forEach(function(e) {
                                    e.id && (-1 === e.id.indexOf("recv") && -1 === e.id.indexOf("inbound_rtp") && -1 === e.id.indexOf("inbound-rtp") && -1 === e.id.indexOf("InboundRTP") || ("audio" === e.mediaType ? (We(t, "audioReceiveBytes", e.bytesReceived), We(t, "audioReceivePackets", e.packetsReceived), We(t, "audioReceivePacketsLost", e.packetsLost)) : (We(t, "videoReceiveBytes", e.bytesReceived), We(t, "videoReceivePacketsLost", e.packetsLost), We(t, "videoReceivePackets", e.packetsReceived), We(t, "videoReceiveFrameRate", e.googFrameRateReceived), We(t, "videoReceiveDecodeFrameRate", e.googFrameRateDecoded), We(t, "videoReceiveResolutionWidth", e.googFrameWidthReceived), We(t, "videoReceiveResolutionHeight", e.googFrameHeightReceived))))
                                }), t
                            }(n) : function(e) {
                                var t = {};
                                return e.forEach(function(e) {
                                    e.id && (-1 === e.id.indexOf("send") && -1 === e.id.indexOf("outbound_rtp") && -1 === e.id.indexOf("OutboundRTP") || ("audio" === e.mediaType ? (We(t, "audioSendBytes", e.bytesSent), We(t, "audioSendPackets", e.packetsSent), We(t, "audioSendPacketsLost", e.packetsLost)) : (We(t, "videoSendBytes", e.bytesSent), We(t, "videoSendPackets", e.packetsSent), We(t, "videoSendPacketsLost", e.packetsLost), We(t, "videoSendFrameRate", e.googFrameRateSent), We(t, "videoSendResolutionWidth", e.googFrameWidthSent), We(t, "videoSendResolutionHeight", e.googFrameHeightSent))))
                                }), t
                            }(n);
                            return e(o)
                        })
                    }).then(function(e) {
                        return t.pc.isSubscriber ? (p() || l()) && (We(e, "videoReceiveResolutionHeight", t.videoHeight), We(e, "videoReceiveResolutionWidth", t.videoWidth)) : ((l() || p()) && (We(e, "videoSendResolutionHeight", t.videoHeight), We(e, "videoSendResolutionWidth", t.videoWidth)), (l() || p()) && t.uplinkStats && We(e, "videoSendPacketsLost", t.uplinkStats.uplink_cumulative_lost)), Promise.resolve(e)
                    })
                }, t.getAudioLevel = function() {
                    return t.audioLevelHelper ? t.audioLevelHelper.getAudioLevel() : t.stream ? 0 !== t.stream.getAudioTracks().length ? (t.audioLevelHelper = new B(t.stream), t.audioLevelHelper.getAudioLevel()) : void le.warning("can't get audioLevel beacuse no audio trace in stream") : (le.warning("can't get audioLevel beacuse no stream exist"), 0)
                }, t.loadAudioBuffer = function(e, i, n) {
                    ze(i, "url"), ze(e, "id");
                    var o = new XMLHttpRequest;
                    o.open("GET", i, !0), o.responseType = "arraybuffer", o.onload = function() {
                        if (o.status > 400) {
                            var i = o.statusText;
                            return le.error("loadAudioBuffer Failed: " + i), n(i)
                        }
                        var r = o.response;
                        t.audioMixing.state == t.audioMixing.states.UNINIT && t._initAudioContext(), t.audioMixing.ctx.decodeAudioData(r, function(i) {
                            t.audioMixing.buffer[e] = i, n(null)
                        }, function(e) {
                            le.error("decodeAudioData Failed:", e), n(e)
                        })
                    }, o.send()
                }, t.createAudioBufferSource = function(e) {
                    if (t.audioMixing.buffer[e.id]) {
                        var i = t.audioMixing.buffer[e.id],
                            n = t.audioMixing.ctx.createBufferSource();
                        n.buffer = i;
                        var o = t.audioMixing.ctx.createGain();
                        if (n.connect(o), o.connect(t.audioMixing.mediaStreamDest), n.gainNode = o, e.loop) n.loop = !0, n.start(0, e.playTime / 1e3);
                        else if (e.cycle > 1)
                            if (u()) {
                                n.loop = !0;
                                var r = e.cycle * i.duration * 1e3 - (e.playTime || 0);
                                n.start(0, e.playTime / 1e3, r / 1e3)
                            } else le.warning("Cycle Param is ignored by current browser"), n.start(0, e.playTime / 1e3);
                        else n.start(0, e.playTime / 1e3);
                        return t.audioMixing.source.push(n), t._flushAudioMixingMuteStatus(), n.addEventListener("ended", function() {
                            for (var e = t.audioMixing.source.length - 1; e >= 0; e--) n == t.audioMixing.source[e] && t.audioMixing.source.splice(e, 1);
                            t.dispatchEvent({
                                type: "audioSourceEnded",
                                source: n
                            })
                        }), n
                    }
                    return le.error("AUDIOBUFFER_NOT_FOUND", e.id), !1
                }, t.on("audioSourceEnded", function(e) {
                    0 != t.audioMixing.source.length || t.audioMixing.state != t.audioMixing.states.BUSY || t.pauseAt || (t.audioMixing.state = t.audioMixing.states.IDLE, t.audioMixing.startAt = null, t.audioMixing.startOffset = null, t.audioMixing.resumeAt = null, t.audioMixing.resumeOffset = null, t.audioMixing.mediaStreamSource.connect(t.audioMixing.mediaStreamDest))
                }), t.clearAudioBufferSource = function() {
                    t.audioBufferSource.forEach(function(e) {
                        e.stop()
                    })
                }, t._initAudioContext = function() {
                    if (t.audioMixing.state !== t.audioMixing.states.UNINIT) throw new Error("Failed to init audio context " + t.audioMixing.state);
                    if (!t.stream) throw new Error("Failed to init audio context. Local Stream not initialized");
                    t.audioMixing.ctx = I(), t.audioMixing.mediaStreamSource = t.audioMixing.ctx.createMediaStreamSource(t.stream), t.audioMixing.mediaStreamDest = t.audioMixing.ctx.createMediaStreamDestination(), t.audioMixing.mediaStreamSource.connect(t.audioMixing.mediaStreamDest);
                    var e = t.stream.getVideoTracks()[0];
                    if (e && t.audioMixing.mediaStreamDest.stream.addTrack(e), t._isAudioMuted() ? (t._unmuteAudio(), t.stream = t.audioMixing.mediaStreamDest.stream, t._muteAudio()) : t.stream = t.audioMixing.mediaStreamDest.stream, t.audioLevelHelper = null, t.pc && t.pc.peerConnection && t.pc.peerConnection) {
                        var i = (t.pc.peerConnection && t.pc.peerConnection.getSenders()).find(function(e) {
                                return e && e.track && "audio" == e.track.kind
                            }),
                            n = t.audioMixing.mediaStreamDest.stream.getAudioTracks()[0];
                        i && i.replaceTrack && n && i.replaceTrack(n)
                    }
                    t.audioMixing.state = t.audioMixing.states.IDLE
                }, t._reloadInEarMonitoringMode = function(e) {
                    if (e) {
                        if (!t.audioMixing.inEarMonitoringModes[e]) return le.error("Invalid InEarMonitoringMode " + e);
                        t.audioMixing.inEarMonitoring = e
                    }
                    switch (t.audioMixing.state == t.audioMixing.states.UNINIT && t._initAudioContext(), t.audioMixing.inEarMonitoring) {
                        case t.audioMixing.inEarMonitoringModes.FILE:
                            t.audioMixing.mediaStreamSource.connectedToDestination && (t.audioMixing.mediaStreamSource.disconnect(t.audioMixing.ctx.destination), t.audioMixing.mediaStreamSource.connectedToDestination = !1);
                        case t.audioMixing.inEarMonitoringModes.ALL:
                            t.audioMixing.source.forEach(function(e) {
                                e.connectedToDestination || (e.gainNode.connect(t.audioMixing.ctx.destination), e.connectedToDestination = !0)
                            })
                    }
                    switch (t.audioMixing.inEarMonitoring) {
                        case t.audioMixing.inEarMonitoringModes.MICROPHONE:
                            t.audioMixing.source.forEach(function(e) {
                                e.connectedToDestination && (e.gainNode.disconnect(t.audioMixing.ctx.destination), e.connectedToDestination = !1)
                            });
                        case t.audioMixing.inEarMonitoringModes.ALL:
                            t.audioMixing.mediaStreamSource.connectedToDestination || (t.audioMixing.mediaStreamSource.connect(t.audioMixing.ctx.destination), t.audioMixing.mediaStreamSource.connectedToDestination = !0)
                    }
                }, t._startAudioMixingBufferSource = function(e) {
                    t.audioMixing.state == t.audioMixing.states.UNINIT && t._initAudioContext();
                    var i = {
                            id: e.filePath,
                            loop: e.loop,
                            cycle: e.cycle,
                            playTime: e.playTime
                        },
                        n = e.replace,
                        o = t.createAudioBufferSource(i);
                    return o ? (o.addEventListener("ended", t._audioMixingFinishedListener, {
                        once: !0
                    }), t._reloadInEarMonitoringMode(), n && t.audioMixing.mediaStreamSource.disconnect(t.audioMixing.mediaStreamDest), o) : null
                }, t._stopAudioMixingBufferSource = function() {
                    var e = t.audioMixing.source[0];
                    return e ? (e.removeEventListener("ended", t._audioMixingFinishedListener), t.audioMixing.mediaStreamSource.connect(t.audioMixing.mediaStreamDest), e.stop(), e) : null
                }, t._flushAudioMixingMuteStatus = function(e) {
                    void 0 !== e && (t.audioMixing.muted = !!e), t.audioMixing.source.forEach(function(e) {
                        t.audioMixing.muted ? e.gainNode.gain.value = 0 : e.gainNode.gain.value = t.audioMixing.volume / 100
                    })
                }, t._handleAudioMixingInvalidStateError = function(e, i) {
                    var n = "INVALID_AUDIO_MIXING_STATE";
                    le.error("Cannot ".concat(e, ": ").concat(n, ", state of audioMixing is ").concat(t.audioMixing.state)), i && i(n)
                }, t._handleAudioMixingNoSourceError = function(e, i) {
                    t.audioMixing.state = t.audioMixing.states.IDLE;
                    var n = "NO_AUDIO_MIXING_SOURCE";
                    le.error("Cannot ".concat(e, ": ").concat(n)), i && i(n)
                }, t._getAudioMixingStates = function() {
                    return {
                        state: t.audioMixing.state,
                        startAt: t.audioMixing.startAt,
                        resumeAt: t.audioMixing.resumeAt,
                        pauseOffset: t.audioMixing.pauseOffset,
                        pauseAt: t.audioMixing.pauseAt,
                        resumeOffset: t.audioMixing.resumeOffset,
                        stopAt: t.audioMixing.stopAt,
                        duration: t._getAudioMixingDuration(),
                        position: t._getAudioMixingCurrentPosition()
                    }
                }, t._audioMixingFinishedListener = function() {
                    t.dispatchEvent({
                        type: "audioMixingFinished"
                    })
                }, t.startAudioMixing = function(e, i) {
                    var n = ne.reportApiInvoke(t.sid, {
                        callback: function(e) {
                            if (e) return i && i(e);
                            t.dispatchEvent({
                                type: "audioMixingPlayed"
                            }), i && i(null)
                        },
                        getStates: t._getAudioMixingStates,
                        name: "startAudioMixing",
                        options: e
                    });
                    Ge(e, "options");
                    var o = e.filePath,
                        r = e.cycle,
                        a = e.loop,
                        s = e.playTime,
                        d = e.replace;
                    if (ze(o, "filePath"), Je(s, "playTime", 0, 1e8), !tt(r) && Je(r, "cycle"), !tt(a) && Ke(a, "loop"), !tt(d) && Ke(d, "replace"), l() && f() < 12) {
                        var c = "BROWSER_NOT_SUPPORT";
                        return le.error("Cannot startAudioMixing: ", c), n(c)
                    }
                    if (t.audioMixing.state == t.audioMixing.states.UNINIT && t._initAudioContext(), t.audioMixing.state === t.audioMixing.states.IDLE) {
                        if (void 0 !== e.cycle && !e.cycle > 0) {
                            c = "Invalid Parmeter cycle: " + e.cycle;
                            return le.error(c), n(c)
                        }
                        if (t.audioMixing.state = t.audioMixing.states.STARTING, t.audioMixing.options = e, t.audioMixing.buffer[e.filePath]) {
                            if (t._startAudioMixingBufferSource(e)) return t.audioMixing.startAt = Date.now(), t.audioMixing.resumeAt = null, t.audioMixing.pauseOffset = null, t.audioMixing.pauseAt = null, t.audioMixing.resumeOffset = null, t.audioMixing.stopAt = null, t.audioMixing.startOffset = e.playTime || 0, t.audioMixing.state = t.audioMixing.states.BUSY, n(null);
                            t.audioMixing.state = t.audioMixing.states.IDLE;
                            var u = "CREATE_BUFFERSOURCE_FAILED";
                            if (n) return n(u);
                            le.error(u)
                        } else t.loadAudioBuffer(e.filePath, e.filePath, function(i) {
                            if (i) t.audioMixing.state = t.audioMixing.states.IDLE, n ? n(i) : le.error(i);
                            else {
                                if (t._startAudioMixingBufferSource(e)) return t.audioMixing.startAt = Date.now(), t.audioMixing.resumeAt = null, t.audioMixing.pauseOffset = null, t.audioMixing.pauseAt = null, t.audioMixing.resumeOffset = null, t.audioMixing.stopAt = null, t.audioMixing.startOffset = e.playTime || 0, t.audioMixing.state = t.audioMixing.states.BUSY, n(null);
                                t.audioMixing.state = t.audioMixing.states.IDLE;
                                i = "CREATE_BUFFERSOURCE_FAILED";
                                if (n) return n(i);
                                le.error(i)
                            }
                        })
                    } else t._handleAudioMixingInvalidStateError("startAudioMixing", n)
                }, t.stopAudioMixing = function(e) {
                    var i = ne.reportApiInvoke(t.sid, {
                        callback: e,
                        getStates: t._getAudioMixingStates,
                        name: "stopAudioMixing"
                    });
                    if (t.audioMixing.state == t.audioMixing.states.BUSY || t.audioMixing.state == t.audioMixing.states.PAUSED) return t._stopAudioMixingBufferSource(), t.audioMixing.stopAt = Date.now(), t.audioMixing.state = t.audioMixing.states.IDLE, void(i && i(null));
                    t._handleAudioMixingInvalidStateError("stopAudioMixing", i)
                }, t.pauseAudioMixing = function(e) {
                    var i = ne.reportApiInvoke(t.sid, {
                        callback: e,
                        getStates: t._getAudioMixingStates,
                        name: "pauseAudioMixing"
                    });
                    if (t.audioMixing.state == t.audioMixing.states.BUSY) return t._stopAudioMixingBufferSource() ? (t.audioMixing.pauseAt = Date.now(), t.audioMixing.state = t.audioMixing.states.PAUSED, t.audioMixing.resumeAt ? t.audioMixing.pauseOffset = t.audioMixing.pauseAt - t.audioMixing.resumeAt + t.audioMixing.resumeOffset : t.audioMixing.pauseOffset = t.audioMixing.pauseAt - t.audioMixing.startAt + t.audioMixing.startOffset, i && i(null)) : void t._handleAudioMixingNoSourceError("pauseAudioMixing", i);
                    t._handleAudioMixingInvalidStateError("pauseAudioMixing", i)
                }, t.resumeAudioMixing = function(e) {
                    var i = ne.reportApiInvoke(t.sid, {
                        callback: function(i, n) {
                            if (i) return e && e(i);
                            t.dispatchEvent({
                                type: "audioMixingPlayed"
                            }), e && e(null)
                        },
                        getStates: t._getAudioMixingStates,
                        name: "resumeAudioMixing"
                    });
                    if (t.audioMixing.state == t.audioMixing.states.PAUSED) {
                        var n = {
                            filePath: t.audioMixing.options.filePath,
                            cycle: t.audioMixing.options.cycle,
                            loop: t.audioMixing.options.loop,
                            playTime: t.audioMixing.pauseOffset,
                            replace: t.audioMixing.options.replace
                        };
                        if (!t._startAudioMixingBufferSource(n)) {
                            var o = "CREATE_BUFFERSOURCE_FAILED";
                            return i(o), void le.error(o)
                        }
                        t.audioMixing.resumeAt = Date.now(), t.audioMixing.resumeOffset = t.audioMixing.pauseOffset, t.audioMixing.state = t.audioMixing.states.BUSY, t.audioMixing.pauseAt = null, t.audioMixing.pauseOffset = null, i(null)
                    } else t._handleAudioMixingInvalidStateError("resumeAudioMixing", i)
                }, t.adjustAudioMixingVolume = function(e) {
                    var i = ne.reportApiInvoke(t.sid, {
                        getStates: t._getAudioMixingStates,
                        name: "adjustAudioMixingVolume"
                    });
                    Je(e, "volume", 0, 100), t.audioMixing.volume = e, t._flushAudioMixingMuteStatus(), i()
                }, t._getAudioMixingDuration = function() {
                    return t.audioMixing.options && t.audioMixing.options.filePath && t.audioMixing.buffer[t.audioMixing.options.filePath] ? 1e3 * t.audioMixing.buffer[t.audioMixing.options.filePath].duration : null
                }, t.getAudioMixingDuration = function() {
                    var e = ne.reportApiInvoke(t.sid, {
                            getStates: t._getAudioMixingStates,
                            name: "getAudioMixingDuration"
                        }),
                        i = t._getAudioMixingDuration();
                    return e(null, i), i
                }, t._getAudioMixingCurrentPosition = function(e) {
                    return t.audioMixing.state == t.audioMixing.states.PAUSED ? t.audioMixing.pauseOffset % t._getAudioMixingDuration() : t.audioMixing.state == t.audioMixing.states.BUSY ? (Date.now() - t.audioMixing.startAt + t.audioMixing.startOffset) % t._getAudioMixingDuration() : void(e && t._handleAudioMixingInvalidStateError("getAudioMixingCurrentPosition"))
                }, t.getAudioMixingCurrentPosition = function() {
                    var e = ne.reportApiInvoke(t.sid, {
                            getStates: t._getAudioMixingStates,
                            name: "getAudioMixingCurrentPosition"
                        }),
                        i = t._getAudioMixingCurrentPosition(!0);
                    return e(null, i), i
                }, t.setAudioMixingPosition = function(e, i) {
                    var n = ne.reportApiInvoke(t.sid, {
                        callback: i,
                        options: e,
                        getStates: t._getAudioMixingStates,
                        name: "setAudioMixingPosition"
                    });
                    if (Je(e, "position", 0, 1e8), t.audioMixing.state == t.audioMixing.states.BUSY) {
                        if (!t._stopAudioMixingBufferSource()) return void t._handleAudioMixingNoSourceError("setAudioMixingPosition", n);
                        var o = {
                            filePath: t.audioMixing.options.filePath,
                            loop: t.audioMixing.options.loop,
                            cycle: t.audioMixing.options.cycle,
                            playTime: e
                        };
                        if (!t._startAudioMixingBufferSource(o)) {
                            var r = "CREATE_BUFFERSOURCE_FAILED";
                            return n && n(r), void le.error(r)
                        }
                        t.audioMixing.startAt = Date.now(), t.audioMixing.startOffset = e, t.audioMixing.resumeAt = null, t.audioMixing.resumeOffset = null, t.audioMixing.pauseOffset = null, t.audioMixing.pauseAt = null
                    } else {
                        if (t.audioMixing.state != t.audioMixing.states.PAUSED) return void t._handleAudioMixingInvalidStateError("setAudioMixingPosition", n);
                        t.audioMixing.pauseOffset = e
                    }
                    n && n(null)
                }, t.setVideoProfile("480P"), t._switchVideoDevice = function(e, i, n) {
                    if (e === t.cameraId) return i && i();
                    t.constraints.video.deviceId = {
                        exact: e
                    };
                    var o = Z()({}, t.constraints);
                    o.audio = !1, le.debug(o), Ue(o, function(o) {
                        try {
                            l() && "11" === f() ? t.replaceTrack(o.getVideoTracks()[0], function() {
                                !1 === t.videoEnabled && (t.stream.getVideoTracks()[0].enabled = !1), i && i()
                            }, n) : (t.removeTrack(t.stream.getVideoTracks()[0]), t.addTrack(o.getVideoTracks()[0]), t.isPlaying() && (t.stop(), t.elementID && t.play(t.elementID)), t.cameraId = e, !1 === t.videoEnabled && (t.stream.getVideoTracks()[0].enabled = !1), i && i())
                        } catch (e) {
                            return n && n(e)
                        }
                    }, function(e) {
                        return n && n(e)
                    })
                }, t._switchAudioDevice = function(e, i, n) {
                    if (e === t.microphoneId) return i && i();
                    !0 === t.constraints.audio ? t.constraints.audio = {
                        deviceId: {
                            exact: e
                        }
                    } : t.constraints.audio.deviceId = {
                        exact: e
                    };
                    var o = Z()({}, t.constraints);
                    o.video = !1, le.debug(o), Ue(o, function(o) {
                        try {
                            l() && "11" === f() ? t.replaceTrack(o.getAudioTracks()[0], function() {
                                !1 === t.audioEnabled && (t.stream.getAudioTracks()[0].enabled = !1), i && i()
                            }, n) : (t.removeTrack(t.stream.getAudioTracks()[0]), t.addTrack(o.getAudioTracks()[0]), t.audioMixing.state === t.audioMixing.states.IDLE && (t.audioMixing.ctx.close(), t.audioMixing.state = t.audioMixing.states.UNINIT), !1 === t.audioEnabled && (t.stream.getAudioTracks()[0].enabled = !1), t.isPlaying() && (t.stop(), t.elementID && t.play(t.elementID)), t.microphoneId = e, i && i())
                        } catch (e) {
                            return n && n(e)
                        }
                    }, function(e) {
                        return n && n(e)
                    })
                }, t.switchDevice = function(e, i, n, o) {
                    ze(i, "deviceId");
                    var r = function() {
                            return t.inSwitchDevice = !1, n && n()
                        },
                        a = function(e) {
                            t.inSwitchDevice = !1, o && "function" == typeof o ? o(e) : le.error(e)
                        };
                    return t.inSwitchDevice ? o && o("Device switch is in process.") : (t.inSwitchDevice = !0, t.local ? t.screen && "video" === e ? a("The device cannot be switched during screen-sharing.") : t.videoSource || t.audioSource ? a("The device cannot be switched when using videoSource or audioSource.") : t.lowStream ? a("The device cannot be switched when using lowstream.") : t.audioMixing.state !== t.audioMixing.states.UNINIT && t.audioMixing.state !== t.audioMixing.states.IDLE ? a("The device cannot be switched when using audio Mixing.") : void je.getDeviceById(i, function() {
                        if ("video" === e) t._switchVideoDevice(i, r, a);
                        else {
                            if ("audio" !== e) return a("Invalid type.");
                            t._switchAudioDevice(i, r, a)
                        }
                    }, function() {
                        return a("The device does not exist.")
                    }) : a("Only the local stream can switch the device."))
                }, t
            },
            nt = ["live", "rtc", "web", "interop", "h264_interop", "web-only"],
            ot = ["vp8", "h264"],
            rt = ["aes-128-xts", "aes-256-xts", "aes-128-ecb"],
            at = function(e) {
                e && e.apply(this, [].slice.call(arguments, 1))
            },
            st = function(e) {
                var t = pe();
                return t.needReconnect = !0, t.isTimeout = !1, t.isInit = !0, t.sendbytes = 0, t.recvbytes = 0, t.startTime = Date.now(), t.hostIndex = 0, t.requestID = 0, e.host instanceof Array ? t.host = e.host : t.host = [e.host], t.getSendBytes = function() {
                    return t.sendbytes
                }, t.getRecvBytes = function() {
                    return t.recvbytes
                }, t.getDuration = function() {
                    return Math.ceil((Date.now() - t.startTime) / 1e3)
                }, t.getURL = function() {
                    return t.connection.url
                }, t.reconnect = function() {
                    t.isInit = !0, t.creatConnection()
                }, t.connectNext = function() {
                    t.isInit = !0, ++t.hostIndex, le.debug("Gateway length:" + t.host.length + " current index:" + t.hostIndex), t.hostIndex >= t.host.length ? t.dispatchEvent(ve({
                        type: "recover"
                    })) : t.creatConnection()
                }, t.replaceHost = function(e) {
                    t.host = e || t.host, t.hostIndex = 0, t.creatConnection()
                }, t.creatConnection = function() {
                    le.debug("start connect:" + t.host[t.hostIndex]), t.lts = (new Date).getTime(), t.connection = new WebSocket("wss://" + t.host[t.hostIndex]), t.connection.onopen = function(e) {
                        le.debug("websockect opened: " + t.host[t.hostIndex]), t.needReconnect = !0, t.isTimeout = !1, t.isInit = !1, t.sendbytes = 0, t.recvbytes = 0, t.startTime = Date.now(), G = 0, z = 0, clearTimeout(t.timeoutCheck), t.dispatchEvent(ve({
                            type: "onopen",
                            event: e,
                            socket: t
                        }))
                    }, t.connection.onmessage = function(e) {
                        t.recvbytes += H(e.data);
                        var i = JSON.parse(e.data);
                        i.hasOwnProperty("_id") ? t.dispatchEvent(ve({
                            type: i._id,
                            msg: i
                        })) : i.hasOwnProperty("_type") && t.dispatchSocketEvent(ve({
                            type: i._type,
                            msg: i.message
                        }))
                    }, t.connection.onclose = function(i) {
                        t.needReconnect ? t.isTimeout || t.isInit ? (le.debug("websockect connect timeout"), ne.joinGateway(e.sid, {
                            lts: t.lts,
                            succ: !1,
                            ec: "timeout",
                            addr: t.connection.url
                        }), t.connectNext()) : t.dispatchEvent(ve({
                            type: "disconnect",
                            event: i
                        })) : (le.debug("websockect closeed"), at(e.onFailure, i), clearTimeout(t.timeoutCheck), t.dispatchEvent(ve({
                            type: "close",
                            event: i
                        })), t.connection.onopen = void 0, t.connection.onclose = void 0, t.connection.onerror = void 0, t.connection.onmessage = void 0, t.connection = void 0)
                    }, t.connection.onerror = function(e) {}, setTimeout(function() {
                        t.connection && t.connection.readyState != WebSocket.OPEN && (t.isTimeout = !0, t.connection.close())
                    }, 5e3)
                }, t.creatConnection(), t.sendMessage = function(e, i) {
                    if (t.connection && t.connection.readyState == WebSocket.OPEN) {
                        var n = JSON.stringify(e);
                        t.sendbytes += H(n), t.connection.send(n)
                    } else i({
                        error: "Gateway not connected"
                    })
                }, t.disconnect = function() {
                    t.needReconnect = !0, t.connection.close()
                }, t.close = function() {
                    t.needReconnect = !1, t.connection.onclose = void 0, t.connection.close()
                }, t.sendSignalCommand = function(e, i) {
                    e._id = "_request_" + t.requestID, t.requestID += 1, "publish_stats" !== e._type && "subscribe_stats" !== e._type && "publish_stats_low" !== e._type && t.on(e._id, function(n) {
                        n.msg && i && i(n.msg._result, n.msg.message), delete t.dispatcher.eventListeners[e._id]
                    }), t.sendMessage(e, function(e) {
                        e.reason = "NOT_CONNECTED", i && i(e.reason, e)
                    })
                }, t
            },
            dt = function(e, t) {
                var i = {
                    connect: function() {
                        t.host = e, i.signal = st(t), i.on = i.signal.on, i.dispatchEvent = i.signal.dispatchEvent, i.signal.on("onopen", function(e) {
                            i.signal.onEvent = function(e) {
                                i.dispatchEvent(ve({
                                    type: e.event,
                                    msg: e
                                }))
                            }, i.dispatchEvent(ve({
                                type: "connect",
                                msg: e
                            }))
                        }), i.signal.on("onError", function(e) {
                            var t = e.msg;
                            onError(t.code, "error")
                        })
                    },
                    getSendBytes: function() {
                        return i.signal.getSendBytes()
                    },
                    getRecvBytes: function() {
                        return i.signal.getRecvBytes()
                    },
                    getDuration: function() {
                        return i.signal.getDuration()
                    },
                    disconnect: function() {
                        i.signal.disconnect()
                    },
                    close: function() {
                        i.signal.close()
                    },
                    getURL: function() {
                        return i.signal.getURL()
                    },
                    reconnect: function() {
                        i.signal.reconnect()
                    },
                    connectNext: function() {
                        i.signal.connectNext()
                    },
                    replaceHost: function(e) {
                        i.signal.replaceHost(e)
                    },
                    emitSimpleMessage: function(e, t) {
                        i.signal.sendSignalCommand(e, t)
                    }
                };
                return i.connect(), i
            },
            ct = function(e, t) {
                var i = !1,
                    n = 0,
                    o = {
                        command: "convergeAllocateEdge",
                        sid: e.sid,
                        appId: e.appId,
                        token: e.token,
                        uid: e.uid,
                        cname: e.cname,
                        ts: Math.floor(Date.now() / 1e3),
                        version: "2.5.1",
                        seq: 0,
                        requestId: 1
                    };
                a.map(function(r) {
                    var s = (new Date).getTime();
                    ut("https://" + r + "/api/v1", o, function(o, d) {
                        if (o) return le.debug("Request proxy server failed: ", o), n++, ne.requestProxyAppCenter(e.sid, {
                            lts: s,
                            succ: !1,
                            APAddr: r,
                            workerManagerList: null,
                            ec: JSON.stringify(o),
                            response: JSON.stringify({
                                err: o,
                                res: d
                            })
                        }), void(n >= a.length && t && t("Get proxy server failed: request all failed"));
                        if (!i)
                            if ((d = JSON.parse(d)).json_body) {
                                var c = JSON.parse(d.json_body);
                                if (le.debug("App return:", c.servers), 200 !== c.code) {
                                    o = "Get proxy server failed: response code [" + c.code + "], reason [ " + c.reason + "]";
                                    le.debug(o), ne.requestProxyAppCenter(e.sid, {
                                        lts: s,
                                        succ: !1,
                                        APAddr: r,
                                        workerManagerList: null,
                                        ec: o,
                                        response: JSON.stringify({
                                            err: o,
                                            res: d
                                        })
                                    })
                                } else {
                                    i = !0;
                                    var u = pt(c.servers);
                                    ne.requestProxyAppCenter(e.sid, {
                                        lts: s,
                                        succ: !0,
                                        APAddr: r,
                                        workerManagerList: JSON.stringify(u),
                                        ec: null,
                                        response: JSON.stringify({
                                            res: d
                                        })
                                    }), t && t(null, u)
                                }
                            } else le.debug("Get proxy server failed: no json_body"), ne.requestProxyAppCenter(e.sid, {
                                lts: s,
                                succ: !1,
                                APAddr: r,
                                workerManagerList: null,
                                ec: "Get proxy server failed: no json_body",
                                response: JSON.stringify({
                                    res: d
                                })
                            })
                    })
                })
            },
            ut = function(e, t, i) {
                var n = {
                    service_name: "webrtc_proxy",
                    json_body: JSON.stringify(t)
                };
                Y(e, n, function(e) {
                    i && i(null, e)
                }, function(e) {
                    i && i(e)
                }, {
                    "X-Packet-Service-Type": 0,
                    "X-Packet-URI": 61
                })
            },
            lt = function(e, t, i) {
                var n = !1,
                    o = 0,
                    r = {
                        command: "request",
                        gatewayType: "http",
                        appId: e.appId,
                        cname: e.cname,
                        uid: e.uid + "",
                        sdkVersion: "2.3.1",
                        sid: e.sid,
                        seq: 1,
                        ts: +new Date,
                        requestId: 3,
                        clientRequest: {
                            appId: e.appId,
                            cname: e.cname,
                            uid: e.uid + "",
                            sid: e.sid
                        }
                    };
                t.map(function(a) {
                    var s = (new Date).getTime();
                    ! function(e, t, i) {
                        Y(e, t, function(e) {
                            i && i(null, e)
                        }, function(e) {
                            i && i(e)
                        })
                    }("https://" + a + ":4000/v2/machine", r, function(r, d) {
                        if (r) return le.debug("Request worker manager failed: ", r), o++, ne.requestProxyWorkerManager(e.sid, {
                            lts: s,
                            succ: !1,
                            workerManagerAddr: a,
                            ec: JSON.stringify(r),
                            response: JSON.stringify({
                                res: d
                            })
                        }), void(o >= t.length && i && i("requeet worker manager server failed: request failed"));
                        if (!n) {
                            if (!(d = JSON.parse(d)).serverResponse) return i && i("requeet worker manager server failed: serverResponse is undefined");
                            n = !0, ne.requestProxyWorkerManager(e.sid, {
                                lts: s,
                                succ: !0,
                                workerManagerAddr: a,
                                ec: JSON.stringify(r),
                                response: JSON.stringify({
                                    res: d
                                })
                            }), i && i(null, {
                                address: a,
                                serverResponse: d.serverResponse
                            })
                        }
                    })
                })
            },
            pt = function(e) {
                if (!e || [] instanceof Array == !1) return [];
                var t = [];
                return e.forEach(function(e) {
                    var i;
                    e.address && e.tcp ? (e.address.match(/^[\.\:\d]+$/) ? i = "".concat(e.address.replace(/[^\d]/g, "-"), ".edge.agora.io") : (le.info("Cannot recognized as IP address ".concat(e.address, ". Used As Host instead")), i = "".concat(e.address, ":").concat(e.tcp)), t.push(i)) : le.error("Invalid address format ", e)
                }), t
            },
            gt = function(e, t, i, n) {
                var o = (new Date).getTime(),
                    r = "";
                t.multiIP && t.multiIP.gateway_ip && (r = {
                    vocs_ip: [t.multiIP.uni_lbs_ip],
                    vos_ip: [t.multiIP.gateway_ip]
                });
                var a = {
                    flag: 4,
                    ts: +new Date,
                    key: t.appId,
                    cname: t.cname,
                    detail: {},
                    uid: t.uid || 0
                };
                r && (a.detail[5] = JSON.stringify(r)), Y(e, a, function(r) {
                    try {
                        var a = JSON.parse(r).res,
                            s = a.code
                    } catch (e) {
                        var d = "requestChooseServer failed with unexpected body " + r;
                        return le.error(d), n(d)
                    }
                    if (s) {
                        var c = he[a.code] || s;
                        return ne.joinChooseServer(t.sid, {
                            lts: o,
                            succ: !1,
                            csAddr: e,
                            serverList: null,
                            ec: c
                        }), n("Get server node failed [" + c + "]", e, c)
                    }
                    var u = [],
                        l = [".agora.io", ".agoraio.cn"],
                        p = 0;
                    if (e.indexOf(l[1]) > -1 && (p = 1), a.addresses.forEach(function(e) {
                            var t;
                            e.ip && e.port ? (e.ip.match(/^[\.\:\d]+$/) ? t = "webrtc-".concat(e.ip.replace(/[^\d]/g, "-")).concat(l[p++ % l.length], ":").concat(e.port) : (le.info("Cannot recognized as IP address ".concat(e.ip, ". Used As Host instead")), t = "".concat(e.ip, ":").concat(e.port)), u.push(t)) : le.error("Invalid address format ", e)
                        }), !u.length) {
                        le.error("Empty Address response", a);
                        c = "EMPTY_ADDRESS_RESPONSE";
                        return ne.joinChooseServer(t.sid, {
                            lts: o,
                            succ: !1,
                            csAddr: e,
                            serverList: null,
                            ec: c
                        }), n("Get server node failed [" + c + "]", e, c)
                    }
                    var g = {
                        gateway_addr: u,
                        uid: a.uid,
                        cid: a.cid,
                        uni_lbs_ip: a.detail
                    };
                    return i(g, e)
                }, function(e, i) {
                    "timeout" === e.type ? (ne.joinChooseServer(t.sid, {
                        lts: o,
                        succ: !1,
                        csAddr: i,
                        serverList: null,
                        ec: "timeout"
                    }), n("Connect choose server timeout", i)) : ne.joinChooseServer(t.sid, {
                        lts: o,
                        succ: !1,
                        csAddr: i,
                        serverList: null,
                        ec: "server_wrong"
                    })
                }, {
                    "X-Packet-Service-Type": 0,
                    "X-Packet-URI": 44
                })
            },
            mt = function(e, t, i) {
                var n = !1,
                    a = null,
                    s = 1,
                    d = 1,
                    c = function i() {
                        n || function(e, t, i) {
                            for (var n = (new Date).getTime(), a = !1, s = !0, d = function(i, o) {
                                    if (a) ne.joinChooseServer(e.sid, {
                                        lts: n,
                                        succ: !0,
                                        csAddr: o,
                                        serverList: i.gateway_addr,
                                        cid: i.cid + "",
                                        uid: i.uid + "",
                                        ec: null
                                    }, !1);
                                    else {
                                        if (clearTimeout(m), a = !0, le.debug("Get gateway address:", i.gateway_addr), e.proxyServer) {
                                            for (var r = i.gateway_addr, s = 0; s < r.length; s++) {
                                                var d = r[s].split(":");
                                                i.gateway_addr[s] = e.proxyServer + "/ws/?h=" + d[0] + "&p=" + d[1]
                                            }
                                            le.debug("Get gateway address:", i.gateway_addr)
                                        }
                                        t(i), ne.joinChooseServer(e.sid, {
                                            lts: n,
                                            succ: !0,
                                            csAddr: o,
                                            serverList: i.gateway_addr,
                                            cid: i.cid + "",
                                            uid: i.uid + "",
                                            ec: null
                                        }, !0)
                                    }
                                }, c = function(e, t, n) {
                                    s && (le.error(e, t, n), n && !Ie.includes(n) && (s = !1, i(n)))
                                }, u = o, l = 0; l < u.length; ++l) {
                                var p;
                                if ("string" == typeof u[l]) {
                                    var g = u[l];
                                    p = e.proxyServer ? "https://".concat(e.proxyServer, "/ap/?url=").concat(g + "/api/v1") : "https://".concat(g, "/api/v1"), le.debug("Connect to choose_server: ".concat(p)), gt(p, e, d, c)
                                } else le.error("Invalid Host", u[l])
                            }
                            var m = setTimeout(function() {
                                if (!a)
                                    for (var t = r, i = 0; i < t.length; ++i)
                                        if ("string" == typeof t[i]) {
                                            var n = t[i];
                                            p = e.proxyServer ? "https://".concat(e.proxyServer, "/ap/?url=").concat(n + "/api/v1") : "https://".concat(n, "/api/v1"), le.debug("Connect to backup_choose_server: ".concat(p)), gt(p, e, d, c)
                                        } else le.error("Invalid Host", t[i])
                            }, 1e3);
                            setTimeout(function() {
                                !a && s && i()
                            }, 6e3)
                        }(e, function(e) {
                            n = !0, clearTimeout(a), t(e)
                        }, function(e) {
                            e ? le.info("Join failed: " + e) : (le.debug("Request gateway list will be restart in " + s + "s"), a = setTimeout(function() {
                                i()
                            }, 1e3 * s), s = s >= 3600 ? 3600 : 2 * s)
                        })
                    };
                e.useProxyServer ? function t() {
                    ! function(e, t) {
                        ct(e, function(i, n) {
                            if (i) return t && t(i);
                            le.debug("getProxyServerList: ", n), lt(e, n, t)
                        })
                    }(e, function(i, n) {
                        if (i) return le.debug(i), le.debug("Request proxy will be restart in " + d + "s"), a = setTimeout(function() {
                            t()
                        }, 1e3 * d), void(d = d >= 3600 ? 3600 : 2 * d);
                        clearTimeout(a);
                        var o = n.address;
                        e.proxyServer = o, e.turnServer = {
                            url: n.address,
                            tcpport: n.serverResponse.tcpport || "3433",
                            udpport: n.serverResponse.udpport || "3478",
                            username: n.serverResponse.username || "test",
                            credential: n.serverResponse.password || "111111",
                            forceturn: !0
                        }, e.turnServer.tcpport += "", e.turnServer.udpport += "", ne.setProxyServer(o), le.setProxyServer(o), c()
                    })
                }() : c()
            },
            ft = {
                ERR_NO_VOCS_AVAILABLE: "tryNext",
                ERR_NO_VOS_AVAILABLE: "tryNext",
                ERR_JOIN_CHANNEL_TIMEOUT: "tryNext",
                WARN_REPEAT_JOIN: "quit",
                ERR_JOIN_BY_MULTI_IP: "recover",
                WARN_LOOKUP_CHANNEL_TIMEOUT: "tryNext",
                WARN_OPEN_CHANNEL_TIMEOUT: "tryNext",
                ERR_VOM_SERVICE_UNAVAILABLE: "tryNext",
                ERR_TOO_MANY_USERS: "tryNext",
                ERR_MASTER_VOCS_UNAVAILABLE: "tryNext",
                ERR_INTERNAL_ERROR: "tryNext",
                notification_test_recover: "recover",
                notification_test_tryNext: "tryNext",
                notification_test_retry: "retry"
            },
            vt = {
                googResidualEchoLikelihood: "A_rel",
                googResidualEchoLikelihoodRecentMax: "A_rem",
                googTypingNoiseState: "A_tns",
                totalSamplesDuration: "A_sd",
                googAdaptationChanges: "A_ac",
                googBandwidthLimitedResolution: "A_blr",
                googCpuLimitedResolution: "A_clr",
                googEncodeUsagePercent: "A_eup",
                googHasEnteredLowResolution: "A_helr",
                googActualEncBitrate: "A_aeb",
                googAvailableReceiveBandwidth: "A_arb",
                googAvailableSendBandwidth: "A_asb",
                googRetransmitBitrate: "A_rb",
                googTargetEncBitrate: "A_teb",
                googCaptureStartNtpTimeMs: "A_csnt",
                googPreemptiveExpandRate: "A_per",
                googPreferredJitterBufferMs: "A_pjbm",
                googSecondaryDecodedRate: "A_sder",
                googSecondaryDiscardedRate: "A_sdir",
                googSpeechExpandRate: "A_ser",
                googFrameHeightReceived: "A_fhr",
                googInterframeDelayMax: "A_ifdm",
                googMinPlayoutDelayMs: "A_mpdm",
                aecDivergentFilterFraction: "A_dff",
                codecImplementationName: "A_cin",
                googEchoCancellationReturnLoss: "A_ecl",
                googEchoCancellationReturnLossEnhancement: "A_ece"
            },
            St = {};
        for (var _t in vt) {
            var ht = vt[_t];
            vt[ht] && console.error("Key Conflict: ".concat(_t)), St[ht] = _t
        }
        var yt = function(e) {
                return vt[e] || e
            },
            It = function e(t) {
                var i = !1,
                    n = function(e) {
                        return {
                            _type: "control",
                            message: e
                        }
                    },
                    o = function(e) {
                        var t = {};
                        return Object.keys(e).forEach(function(i) {
                            t[yt(i)] = e[i]
                        }), {
                            _type: "subscribe_related_stats",
                            options: t
                        }
                    },
                    r = function(e, t, i) {
                        return {
                            _type: "publish",
                            options: e,
                            sdp: t,
                            p2pid: i
                        }
                    },
                    a = e.DISCONNECTED,
                    s = e.CONNECTING,
                    d = e.CONNECTED,
                    u = e.DISCONNECTING,
                    g = a,
                    m = pe();
                Object.defineProperty(m, "state", {
                    set: function(t) {
                        var i = g;
                        g = t, i !== t && m.dispatchEvent({
                            type: "connection-state-change",
                            prevState: e.connetionStateMap[i],
                            curState: e.connetionStateMap[t]
                        })
                    },
                    get: function() {
                        return g
                    }
                }), m.socket = void 0, m.state = a, m.mode = t.mode, m.role = t.role, m.codec = t.codec, m.config = {}, m.timers = {}, m.timer_counter = {}, m.localStreams = {}, m.remoteStreams = {}, m.attemps = 1, m.p2p_attemps = 1, m.audioLevel = {}, m.activeSpeaker = void 0, m.reconnectMode = "retry", m.rejoinAttempt = 0, m.hasChangeBGPAddress = !1, m.traffic_stats = {}, m.p2ps = new Map, m.firstFrameTimer = new Map, m.firstAudioDecodeTimer = new Map, m.liveStreams = new Map, m.injectLiveStreams = new Map, m.remoteStreamsInChannel = new Set, m.inChannelInfo = {
                    joinAt: null,
                    duration: 0
                };
                var f = at;
                m.p2pCounter = function(e) {
                    isNaN(e) && (e = 1e3);
                    var t = +new Date,
                        i = (t = (9301 * t + 49297) % 233280) / 233280;
                    return Math.ceil(i * e)
                }(1e5), m.generateP2PId = function() {
                    return ++m.p2pCounter
                }, m.audioVolumeIndication = {
                    enabled: !1,
                    sortedAudioVolumes: [],
                    smooth: 3,
                    interval: 2e3
                }, m.remoteVideoStreamTypes = {
                    REMOTE_VIDEO_STREAM_HIGH: 0,
                    REMOTE_VIDEO_STREAM_LOW: 1,
                    REMOTE_VIDEO_STREAM_MEDIUM: 2
                }, m.streamFallbackTypes = {
                    STREAM_FALLBACK_OPTION_DISABLED: 0,
                    STREAM_FALLBACK_OPTION_VIDEO_STREAM_LOW: 1,
                    STREAM_FALLBACK_OPTION_AUDIO_ONLY: 2
                }, m.configPublisher = function(e) {
                    m.config = e
                }, m.getGatewayInfo = function(e, t) {
                    h({
                        _type: "gateway_info"
                    }, e, t)
                }, m.setClientRole = function(e, t) {
                    le.debug("setClientRole to ".concat(e));
                    var i = ne.reportApiInvoke(m.joinInfo.sid, {
                        name: "_setClientRole",
                        callback: t
                    });
                    h(function(e) {
                        return {
                            _type: "set_client_role",
                            message: e
                        }
                    }(e), function() {
                        m.role = e, m.dispatchEvent({
                            type: "client-role-changed",
                            role: e
                        }), i && i(null, {
                            role: e
                        })
                    }, function(t) {
                        var n = t && t.code ? t.code : 0,
                            o = Ee[n];
                        if ("ERR_ALREADY_IN_USE" === o) return i && i(null);
                        o || (o = "UNKNOW_ERROR_".concat(n)), le.error("set Client role error to " + e + ": " + o), i && i(o)
                    })
                }, m.join = function(e, i, n, o) {
                    e.useProxyServer && (m.hasChangeBGPAddress = !0);
                    var r = (new Date).getTime(),
                        c = e.uid;
                    if (m.inChannelInfo.joinAt && (m.inChannelInfo.duration += r - m.inChannelInfo.joinAt), m.inChannelInfo.joinAt = r, m.state !== s) return le.error("GatewayClient.join Failed: state ", m.state), o && o(be.INVALID_OPERATION), void ne.joinGateway(e.sid, {
                        lts: r,
                        succ: !1,
                        ec: be.INVALID_OPERATION,
                        addr: null
                    });
                    if (null !== c && void 0 !== c && parseInt(c) !== c) return le.error("Input uid is invalid"), m.state = a, o && o(be.INVALID_PARAMETER), void ne.joinGateway(e.sid, {
                        lts: r,
                        succ: !1,
                        ec: be.INVALID_PARAMETER,
                        addr: null
                    });
                    var u = Et.register(m, {
                        uid: c,
                        cname: e && e.cname
                    });
                    if (u) return m.state = a, o && o(u), void ne.joinGateway(e.sid, {
                        lts: r,
                        succ: !1,
                        ec: u,
                        addr: null
                    });
                    m.joinInfo = Z()({}, e), m.uid = c, m.key = i, _(e, function(i) {
                        m.state = d, le.debug("Connected to gateway server"), m.pingTimer = setInterval(function() {
                            var e = Date.now();
                            h({
                                _type: "ping"
                            }, function() {
                                var t = Date.now() - e;
                                h(function(e) {
                                    return {
                                        _type: "signal_stats",
                                        message: e
                                    }
                                }({
                                    pingpongElapse: t
                                }), function() {}, function(e) {})
                            }, function(e) {})
                        }, 3e3), h(function(e) {
                            var i = e.role,
                                n = {
                                    appId: t.appId,
                                    key: m.key,
                                    channel: m.joinInfo.cname,
                                    uid: m.uid,
                                    version: "2.5.1",
                                    browser: navigator.userAgent,
                                    mode: t.mode,
                                    codec: t.codec,
                                    role: i,
                                    config: m.config
                                };
                            return m.joinInfo.hasOwnProperty("stringUid") && (n.stringUid = m.joinInfo.stringUid), {
                                _type: "join1",
                                message: n
                            }
                        }({
                            role: m.role
                        }), function(t) {
                            if (ne.joinGateway(e.sid, {
                                    lts: r,
                                    succ: !0,
                                    ec: null,
                                    vid: t.vid,
                                    addr: m.socket.getURL()
                                }), m.rejoinAttempt = 0, n && n(t.uid), m.dispatchEvent({
                                    type: "join"
                                }), m.leaveOnConnected) {
                                le.info("Calling Leave() once joined");
                                var i = m.leaveOnConnected;
                                m.leaveOnConnected = null, m.leave(i.onSuccess, i.onFailure)
                            }
                        }, function(t) {
                            if (le.error("User join failed [" + t + "]"), ft[t] && m.rejoinAttempt < 4) {
                                if (m._doWithAction(ft[t], n, o), m.leaveOnConnected) {
                                    le.error("Calling Leave() once joined: Join Failed");
                                    var i = m.leaveOnConnected;
                                    m.leaveOnConnected = null, i.onFailure(be.JOIN_CHANNEL_FAILED)
                                }
                            } else o && o(t);
                            ne.joinGateway(e.sid, {
                                lts: r,
                                succ: !1,
                                ec: t,
                                addr: m.socket.getURL()
                            })
                        })
                    }, function(t) {
                        le.error("User join failed [" + t + "]"), o && o(t), ne.joinGateway(e.sid, {
                            lts: r,
                            succ: !1,
                            ec: t,
                            addr: m.socket.getURL()
                        })
                    }), clearInterval(m.timers.trafficStats), m.timers.trafficStats = setInterval(function() {
                        h({
                            _type: "traffic_stats"
                        }, function(e) {
                            m.traffic_stats = e;
                            var t = m.localStreams[c];
                            t && (t.traffic_stats = {
                                access_delay: e.access_delay
                            }), e.peer_delay && e.peer_delay.forEach(function(t) {
                                var i = m.remoteStreams[t.peer_uid];
                                i && (i.traffic_stats = {
                                    access_delay: e.access_delay,
                                    e2e_delay: t.e2e_delay,
                                    audio_delay: t.audio_delay,
                                    video_delay: t.video_delay
                                })
                            })
                        })
                    }, 3e3), m.resetAudioVolumeIndication()
                }, m.leave = function(e, t) {
                    switch (m.state) {
                        case a:
                            return le.debug("Client Already in DISCONNECTED status"), void f(e);
                        case u:
                            return le.error("Client Already in DISCONNECTING status"), void f(t, be.INVALID_OPERATION);
                        case s:
                            return m.leaveOnConnected ? (le.error("Client.leave() already called"), void f(t, be.INVALID_OPERATION)) : (le.debug("Client connecting. Waiting for Client Fully Connected(And leave)"), void(m.leaveOnConnected = {
                                onSuccess: e,
                                onFailure: t
                            }))
                    }
                    var i = Et.unregister(m);
                    if (i) le.error(i);
                    else {
                        for (var n in m.state = u, clearInterval(m.pingTimer), m.timers) m.timers.hasOwnProperty(n) && clearInterval(m.timers[n]);
                        for (var n in m.inChannelInfo.joinAt && (m.inChannelInfo.duration += Date.now() - m.inChannelInfo.joinAt, m.inChannelInfo.joinAt = null), h({
                                _type: "leave"
                            }, function(t) {
                                m.socket.close(), m.socket = void 0, le.info("Leave channel success"), m.state = a, e && e(t)
                            }, function(e) {
                                le.error("Leave Channel Failed", e), m.state = d, t && t(e)
                            }), m.localStreams)
                            if (m.localStreams.hasOwnProperty(n)) {
                                var o = m.localStreams[n];
                                delete m.localStreams[n], void 0 !== o.pc && (o.pc.close(), o.pc = void 0)
                            } E()
                    }
                }, m.publish = function(e, t, i) {
                    var o = (new Date).getTime(),
                        a = !1;
                    if (e.publishLTS = o, "object" !== c()(e) || null === e) return le.error("Invalid local stream"), i && i(be.INVALID_LOCAL_STREAM), void ne.publish(m.joinInfo.sid, {
                        lts: o,
                        succ: !1,
                        audioName: e.hasAudio() && e.audioName,
                        videoName: e.hasVideo() && e.videoName,
                        screenName: e.hasScreen() && e.screenName,
                        ec: be.INVALID_LOCAL_STREAM
                    });
                    if (null === e.stream && void 0 === e.url) return le.error("Invalid local media stream"), i && i(be.INVALID_LOCAL_STREAM), void ne.publish(m.joinInfo.sid, {
                        lts: o,
                        succ: !1,
                        audioName: e.hasAudio() && e.audioName,
                        videoName: e.hasVideo() && e.videoName,
                        screenName: e.hasScreen() && e.screenName,
                        ec: be.INVALID_LOCAL_STREAM
                    });
                    if (m.state !== d) return le.error("User is not in the session"), i && i(be.INVALID_OPERATION), void ne.publish(m.joinInfo.sid, {
                        lts: o,
                        succ: !1,
                        audioName: e.hasAudio() && e.audioName,
                        videoName: e.hasVideo() && e.videoName,
                        screenName: e.hasScreen() && e.screenName,
                        ec: be.INVALID_OPERATION
                    });
                    var s = e.getAttributes() || {};
                    if (e.local && void 0 === m.localStreams[e.getId()] && (e.hasAudio() || e.hasVideo() || e.hasScreen())) {
                        var u = m.generateP2PId();
                        if (m.p2ps.set(u, e), e.p2pId = u, void 0 !== e.url) y(r({
                            state: "url",
                            audio: e.hasAudio(),
                            video: e.hasVideo(),
                            attributes: e.getAttributes(),
                            mode: m.mode
                        }, e.url), function(t, i) {
                            "success" === t ? (e.getUserId() !== i && e.setUserId(i), m.localStreams[i] = e, e.onClose = function() {
                                m.unpublish(e)
                            }) : le.error("Publish local stream failed", t)
                        });
                        else {
                            m.localStreams[e.getId()] = e, e.pc = Be({
                                callback: function(s) {
                                    le.debug("SDP exchange in publish : send offer --  ", JSON.parse(s)), y(r({
                                        state: "offer",
                                        id: e.getId(),
                                        audio: e.hasAudio(),
                                        video: e.hasVideo() || e.hasScreen(),
                                        attributes: e.getAttributes(),
                                        dtx: e.DTX,
                                        hq: e.highQuality,
                                        lq: e.lowQuality,
                                        stereo: e.stereo,
                                        speech: e.speech,
                                        mode: m.mode,
                                        codec: m.codec,
                                        p2pid: u,
                                        turnip: m.joinInfo.turnServer.url,
                                        turnport: Number(m.joinInfo.turnServer.udpport),
                                        turnusername: m.joinInfo.turnServer.username,
                                        turnpassword: m.joinInfo.turnServer.credential
                                    }, s), function(d, c) {
                                        if ("error" === d) return le.error("Publish local stream failed"), i && i(be.PUBLISH_STREAM_FAILED), void ne.publish(m.joinInfo.sid, {
                                            lts: o,
                                            succ: !1,
                                            audioName: e.hasAudio() && e.audioName,
                                            videoName: e.hasVideo() && e.videoName,
                                            screenName: e.hasScreen() && e.screenName,
                                            localSDP: s,
                                            ec: be.PUBLISH_STREAM_FAILED
                                        });
                                        e.pc.onsignalingmessage = function(t) {
                                            e.pc.onsignalingmessage = function() {}, y(r({
                                                state: "ok",
                                                id: e.getId(),
                                                audio: e.hasAudio(),
                                                video: e.hasVideo(),
                                                screen: e.hasScreen(),
                                                attributes: e.getAttributes(),
                                                mode: m.mode
                                            }, t)), e.getUserId() !== c.id && e.setUserId(c.id), le.info("Local stream published with uid", c.id), e.onClose = function() {
                                                m.unpublish(e)
                                            }, e._onAudioUnmute = function() {
                                                h(n({
                                                    action: "audio-out-on",
                                                    streamId: e.getId()
                                                }), function() {}, function() {})
                                            }, e._onVideoUnmute = function() {
                                                h(n({
                                                    action: "video-out-on",
                                                    streamId: e.getId()
                                                }), function() {}, function() {})
                                            }, e._onAudioMute = function() {
                                                h(n({
                                                    action: "audio-out-off",
                                                    streamId: e.getId()
                                                }), function() {}, function() {})
                                            }, e._onVideoMute = function() {
                                                h(n({
                                                    action: "video-out-off",
                                                    streamId: e.getId()
                                                }), function() {}, function() {})
                                            }, e.getId() === e.getUserId() && (e.isAudioOn() || e.hasAudio() && (le.debug("local stream audio mute"), e._onAudioMute()), e.isVideoOn() || (e.hasVideo() || e.hasScreen()) && (le.debug("local stream video mute"), e._onVideoMute()))
                                        }, e.pc.oniceconnectionstatechange = function(n) {
                                            if ("failed" === n) {
                                                if (void 0 != m.timers[e.getId()] && (clearInterval(m.timers[e.getId()]), clearInterval(m.timers[e.getId()] + "_RelatedStats")), le.error("Publisher connection is lost -- streamId: " + e.getId() + " p2pId: " + u), m.p2ps.delete(u), le.debug("publish p2p failed: ", m.p2ps), !a) return a = !0, ne.publish(m.joinInfo.sid, {
                                                    lts: o,
                                                    succ: !1,
                                                    audioName: e.hasAudio() && e.audioName,
                                                    videoName: e.hasVideo() && e.videoName,
                                                    screenName: e.hasScreen() && e.screenName,
                                                    ec: be.PEERCONNECTION_FAILED
                                                }), m.dispatchEvent(fe({
                                                    type: "pubP2PLost",
                                                    stream: e
                                                })), i && i(be.PEERCONNECTION_FAILED);
                                                m.dispatchEvent(fe({
                                                    type: "pubP2PLost",
                                                    stream: e
                                                }))
                                            } else if ("connected" === n && (le.debug("publish p2p connected: ", m.p2ps), !a)) return a = !0, ne.publish(m.joinInfo.sid, {
                                                lts: o,
                                                succ: !0,
                                                audioName: e.hasAudio() && e.audioName,
                                                videoName: e.hasVideo() && e.videoName,
                                                screenName: e.hasScreen() && e.screenName,
                                                ec: null
                                            }), t && t()
                                        }, le.debug("SDP exchange in publish : receive answer --  ", JSON.parse(d)), e.pc.processSignalingMessage(d)
                                    })
                                },
                                audio: e.hasAudio(),
                                video: e.hasVideo(),
                                screen: e.hasScreen(),
                                isSubscriber: !1,
                                stunServerUrl: m.stunServerUrl,
                                turnServer: m.joinInfo.turnServer,
                                maxAudioBW: s.maxAudioBW,
                                minVideoBW: s.minVideoBW,
                                maxVideoBW: s.maxVideoBW,
                                mode: m.mode,
                                codec: m.codec,
                                isVideoMute: !e.videoEnabled,
                                isAudioMute: !e.audioEnabled,
                                maxFrameRate: e.attributes.maxFrameRate
                            }), e.pc.addStream(e.stream), le.debug("PeerConnection add stream :", e.stream), e.pc.onnegotiationneeded = function(t) {
                                y(r({
                                    state: "negotiation",
                                    p2pid: u
                                }, t), function(t, i) {
                                    e.pc.processSignalingMessage(t)
                                })
                            }, m.timers[e.getId()] = setInterval(function() {
                                var t = 0;
                                e && e.pc && e.pc.getStats && e.pc.getStatsRate(function(i) {
                                    i.forEach(function(i) {
                                        if (i && i.id && !/_recv$/.test(i.id) && !/^time$/.test(i.id) && e.getUserId())
                                            if (-1 === i.id.indexOf("outbound_rtp") && -1 === i.id.indexOf("OutboundRTP") || "video" !== i.mediaType || (i.googFrameWidthSent = e.videoWidth + "", i.googFrameHeightSent = e.videoHeight + ""), e.getId() == e.getUserId()) {
                                                var n = 200 * t;
                                                t++, setTimeout(function() {
                                                    h(function(e) {
                                                        var t = {};
                                                        return Object.keys(e).forEach(function(i) {
                                                            t[yt(i)] = e[i]
                                                        }), {
                                                            _type: "publish_stats",
                                                            options: {
                                                                stats: t
                                                            },
                                                            sdp: null
                                                        }
                                                    }(i), null, null)
                                                }, n)
                                            } else {
                                                n = 200 * t;
                                                t++, setTimeout(function() {
                                                    h(function(e) {
                                                        var t = {};
                                                        return Object.keys(e).forEach(function(i) {
                                                            t[yt(i)] = e[i]
                                                        }), {
                                                            _type: "publish_stats_low",
                                                            options: {
                                                                stats: t
                                                            },
                                                            sdp: null
                                                        }
                                                    }(i), null, null)
                                                }, n)
                                            }
                                    })
                                })
                            }, 3e3);
                            var l = function() {
                                e && e.pc && e.pc.getVideoRelatedStats && e.pc.getVideoRelatedStats(function(t) {
                                    e.getId() === e.getUserId() ? h(function(e) {
                                        var t = {};
                                        return Object.keys(e).forEach(function(i) {
                                            t[yt(i)] = e[i]
                                        }), {
                                            _type: "publish_related_stats",
                                            options: t
                                        }
                                    }(t), null, null) : h(function(e) {
                                        var t = {};
                                        return Object.keys(e).forEach(function(i) {
                                            t[yt(i)] = e[i]
                                        }), {
                                            _type: "publish_related_stats_low",
                                            options: t
                                        }
                                    }(t), null, null)
                                })
                            };
                            l(), m.timers[e.getId() + "_RelatedStats"] = setInterval(l, 1e3)
                        }
                    }
                }, m.unpublish = function(e, t, i) {
                    return "object" !== c()(e) || null === e ? (le.error("Invalid local stream"), void f(i, be.INVALID_LOCAL_STREAM)) : m.state !== d ? (le.error("User not in the session"), void f(i, be.INVALID_OPERATION)) : (void 0 != m.timers[e.getId()] && (clearInterval(m.timers[e.getId()]), clearInterval(m.timers[e.getId() + "_RelatedStats"])), void(void 0 !== m.socket ? e.local && void 0 !== m.localStreams[e.getId()] ? (delete m.localStreams[e.getId()], h(function(e) {
                        return {
                            _type: "unpublish",
                            message: e
                        }
                    }(e.getUserId())), (e.hasAudio() || e.hasVideo() || e.hasScreen()) && void 0 === e.url && void 0 !== e.pc && (e.pc.close(), e.pc = void 0), e.onClose = void 0, e._onAudioMute = void 0, e._onAudioUnute = void 0, e._onVideoMute = void 0, e._onVideoUnmute = void 0, m.p2ps.delete(e.p2pId), t && t()) : (le.error("Invalid local stream"), f(i, be.INVALID_LOCAL_STREAM)) : (le.error("User not in the session"), f(i, be.INVALID_OPERATION))))
                }, m.subscribe = function(e, t, i) {
                    var r = (new Date).getTime();
                    e.subscribeLTS = r;
                    var a = !1;
                    if (le.info("Gatewayclient ".concat(m.uid, " Subscribe ").concat(e.getId(), ": ").concat(JSON.stringify(e.subscribeOptions))), "object" !== c()(e) || null === e) return le.error("Invalid remote stream"), i && i(be.INVALID_REMOTE_STREAM), void ne.subscribe(m.joinInfo.sid, {
                        lts: r,
                        succ: !1,
                        video: e.subscribeOptions && e.subscribeOptions.video,
                        audio: e.subscribeOptions && e.subscribeOptions.audio,
                        peerid: e.getId() + "",
                        ec: be.INVALID_REMOTE_STREAM
                    });
                    if (m.state !== d && (le.error("User is not in the session"), !a)) return a = !0, ne.subscribe(m.joinInfo.sid, {
                        lts: r,
                        succ: !1,
                        video: e.subscribeOptions && e.subscribeOptions.video,
                        audio: e.subscribeOptions && e.subscribeOptions.audio,
                        peerid: e.getId() + "",
                        ec: be.INVALID_OPERATION
                    }), i && i(be.INVALID_OPERATION);
                    if (!e.local && m.remoteStreams.hasOwnProperty(e.getId()))
                        if (e.hasAudio() || e.hasVideo() || e.hasScreen()) {
                            var s = m.generateP2PId();
                            m.p2ps.set(s, e), e.p2pId = s, e.pc = Be({
                                callback: function(t) {
                                    le.debug("SDP exchange in subscribe : send offer --  ", JSON.parse(t));
                                    var n = Z()({
                                        streamId: e.getId(),
                                        video: !0,
                                        audio: !0,
                                        mode: m.mode,
                                        codec: m.codec,
                                        p2pid: s,
                                        turnip: m.joinInfo.turnServer.url,
                                        turnport: Number(m.joinInfo.turnServer.udpport),
                                        turnusername: m.joinInfo.turnServer.username,
                                        turnpassword: m.joinInfo.turnServer.credential
                                    }, e.subscribeOptions);
                                    y(function(e, t, i) {
                                        return {
                                            _type: "subscribe",
                                            options: e,
                                            sdp: t,
                                            p2pid: i
                                        }
                                    }(n, t), function(t) {
                                        if ("error" === t) return le.error("Subscribe remote stream failed, closing stream ", e.getId()), e.close(), i && i(be.SUBSCRIBE_STREAM_FAILED), void ne.subscribe(m.joinInfo.sid, {
                                            lts: r,
                                            succ: !1,
                                            video: e.subscribeOptions && e.subscribeOptions.video,
                                            audio: e.subscribeOptions && e.subscribeOptions.audio,
                                            peerid: e.getId() + "",
                                            ec: be.SUBSCRIBE_STREAM_FAILED
                                        });
                                        le.debug("SDP exchange in subscribe : receive answer --  ", JSON.parse(t)), e.pc.processSignalingMessage(t)
                                    })
                                },
                                nop2p: !0,
                                audio: !0,
                                video: !0,
                                screen: e.hasScreen(),
                                isSubscriber: !0,
                                stunServerUrl: m.stunServerUrl,
                                turnServer: m.joinInfo.turnServer,
                                isVideoMute: !e.videoEnabled,
                                isAudioMute: !e.audioEnabled,
                                uid: e.getId()
                            }), e.pc.onaddstream = function(t, i) {
                                if (e._onAudioUnmute = function() {
                                        h(n({
                                            action: "audio-in-on",
                                            streamId: e.getId()
                                        }), function() {}, function() {})
                                    }, e._onAudioMute = function() {
                                        h(n({
                                            action: "audio-in-off",
                                            streamId: e.getId()
                                        }), function() {}, function() {})
                                    }, e._onVideoUnmute = function() {
                                        h(n({
                                            action: "video-in-on",
                                            streamId: e.getId()
                                        }), function() {}, function() {})
                                    }, e._onVideoMute = function() {
                                        h(n({
                                            action: "video-in-off",
                                            streamId: e.getId()
                                        }), function() {}, function() {})
                                    }, "ontrack" === i && "video" === t.track.kind || "onaddstream" === i) {
                                    le.info("Remote stream subscribed with uid ", e.getId());
                                    var o = m.remoteStreams[e.getId()];
                                    if (m.remoteStreams[e.getId()].stream = "onaddstream" === i ? t.stream : t.streams[0], m.remoteStreams[e.getId()].hasVideo()) {
                                        if (p() || l()) {
                                            var r = m.remoteStreams[e.getId()].stream;
                                            U(r, function(t, i) {
                                                e.videoWidth = t, e.videoHeight = i
                                            }, function(e) {
                                                return le.warning("vsResHack failed:" + e)
                                            })
                                        }
                                    } else m.remoteStreams[e.getId()]._muteVideo();
                                    o && o.isPlaying() && o.elementID && (le.debug("Reload Player " + o.elementID + " StreamId " + o.getId()), e.audioOutput = o.audioOutput, o.stop(), e.play(o.elementID, o.playOptions));
                                    var a = me({
                                        type: "stream-subscribed",
                                        stream: m.remoteStreams[e.getId()]
                                    });
                                    m.dispatchEvent(a)
                                }
                            }, m.timers[e.getId()] = setInterval(function() {
                                var t = 0;
                                e && e.pc && e.pc.getStats && e.pc.getStatsRate(function(i) {
                                    i.forEach(function(i) {
                                        if (i && i.id) {
                                            if (/_send$/.test(i.id) || /^time$/.test(i.id) || /^bweforvideo$/.test(i.id)) return; - 1 === i.id.indexOf("inbound_rtp") && -1 === i.id.indexOf("inbound-rtp") || "video" !== i.mediaType || (i.googFrameWidthReceived = e.videoWidth + "", i.googFrameHeightReceived = e.videoHeight + "");
                                            var n = 200 * t;
                                            t++;
                                            var o = e.getId();
                                            setTimeout(function() {
                                                y(function(e, t) {
                                                    var i = {};
                                                    return Object.keys(t).forEach(function(e) {
                                                        i[yt(e)] = t[e]
                                                    }), {
                                                        _type: "subscribe_stats",
                                                        options: {
                                                            id: e,
                                                            stats: i
                                                        },
                                                        sdp: null
                                                    }
                                                }(o, i), null, null)
                                            }, n)
                                        } else;
                                    })
                                })
                            }, 3e3), m.timers[e.getId() + "_RelatedStats"] = setInterval(function() {
                                e && e.pc && (e.pc.getVideoRelatedStats && e.pc.getVideoRelatedStats(function(e) {
                                    h(o(e), null, null)
                                }), e.pc.getAudioRelatedStats && e.pc.getAudioRelatedStats(function(e) {
                                    h(o(e), null, null)
                                }))
                            }, 1e3), m.audioLevel[e.getId()] = 0, m.timers[e.getId() + "audio"] = setInterval(function() {
                                m.hasListeners("active-speaker") && e && e.pc && "established" === e.pc.state && e.pc.getStats && e.pc.getStats(function(t) {
                                    t.forEach(function(t) {
                                        if ("audio" === t.mediaType) {
                                            if (t.audioOutputLevel > 5e3)
                                                for (var i in m.audioLevel[e.getId()] < 20 && (m.audioLevel[e.getId()] += 1), m.audioLevel) parseInt(i) !== e.getId() && m.audioLevel[i] > 0 && (m.audioLevel[i] -= 1);
                                            var n = Object.keys(m.audioLevel).sort(function(e, t) {
                                                return m.audioLevel[t] - m.audioLevel[e]
                                            });
                                            if (m.activeSpeaker !== n[0]) {
                                                var o = fe({
                                                    type: "active-speaker",
                                                    uid: n[0]
                                                });
                                                m.dispatchEvent(o), m.activeSpeaker = n[0], le.debug("Update active speaker:" + m.activeSpeaker)
                                            }
                                        }
                                    })
                                })
                            }, 50), e.pc.oniceconnectionstatechange = function(n) {
                                if ("failed" === n) void 0 != m.timers[e.getId()] && (clearInterval(m.timers[e.getId()]), clearInterval(m.timers[e.getId()] + "audio")), le.error("Subscriber connection is lost -- streamId: " + e.getId() + " p2pId: " + s), le.debug("subscribe p2p failed: ", m.p2ps), a || (a = !0, i && i(be.PEERCONNECTION_FAILED), ne.subscribe(m.joinInfo.sid, {
                                    lts: r,
                                    succ: !1,
                                    video: e.subscribeOptions && e.subscribeOptions.video,
                                    audio: e.subscribeOptions && e.subscribeOptions.audio,
                                    peerid: e.getId() + "",
                                    ec: be.PEERCONNECTION_FAILED
                                })), m.remoteStreams[e.getId()] && m.p2ps.has(s) && (m.p2ps.delete(s), m.dispatchEvent(fe({
                                    type: "subP2PLost",
                                    stream: e
                                })));
                                else if ("connected" === n && (le.debug("subscribe p2p connected: ", m.p2ps), !a)) return a = !0, ne.subscribe(m.joinInfo.sid, {
                                    lts: r,
                                    succ: !0,
                                    video: e.subscribeOptions && e.subscribeOptions.video,
                                    audio: e.subscribeOptions && e.subscribeOptions.audio,
                                    peerid: e.getId() + "",
                                    ec: null
                                }), m._adjustPCMuteStatus(e), m.firstAudioDecodeTimer.set(e.getId(), setInterval(function() {
                                    e.pc ? e.pc.getStats(function(t) {
                                        t.forEach(function(t) {
                                            -1 !== t.id.indexOf("recv") && "audio" === t.mediaType && parseInt(t.googDecodingNormal) > 0 && (clearInterval(m.firstAudioDecodeTimer.get(e.getId())), m.firstAudioDecodeTimer.delete(e.getId()), ne.reportApiInvoke(m.joinInfo.sid, {
                                                name: "firstAudioDecode"
                                            })(null, {
                                                elapse: Date.now() - e.subscribeLTS
                                            }))
                                        })
                                    }) : (clearInterval(m.firstAudioDecodeTimer.get(e.getId())), m.firstAudioDecodeTimer.delete(e.getId()))
                                }, 100)), m.firstFrameTimer.set(e.getId(), setInterval(function() {
                                    e.pc ? e.pc.getStats(function(t) {
                                        t.forEach(function(t) {
                                            -1 === t.id.indexOf("recv") && -1 === t.id.indexOf("inbound_rtp") && -1 === t.id.indexOf("inbound-rtp") && -1 === t.id.indexOf("InboundRTP") || "video" === t.mediaType && (t.framesDecoded > 0 || t.googFramesDecoded > 0) && (clearInterval(m.firstFrameTimer.get(e.getId())), m.firstFrameTimer.delete(e.getId()), e.firstFrameTime = (new Date).getTime() - e.subscribeLTS, ne.firstRemoteFrame(m.joinInfo.sid, {
                                                lts: (new Date).getTime(),
                                                peerid: e.getId() + "",
                                                succ: !0,
                                                width: +t.googFrameWidthReceived,
                                                height: +t.googFrameHeightReceived
                                            }))
                                        })
                                    }) : (clearInterval(m.firstFrameTimer.get(e.getId())), m.firstFrameTimer.delete(e.getId()))
                                }, 100)), t && t()
                            }
                        } else le.error("Invalid remote stream"), a || (a = !0, i && i(be.INVALID_REMOTE_STREAM), ne.subscribe(m.joinInfo.sid, {
                            lts: r,
                            succ: !1,
                            video: e.subscribeOptions && e.subscribeOptions.video,
                            audio: e.subscribeOptions && e.subscribeOptions.audio,
                            peerid: e.getId() + "",
                            ec: be.INVALID_REMOTE_STREAM
                        }));
                    else le.error("No such remote stream"), a || (a = !0, i && i(be.NO_SUCH_REMOTE_STREAM), ne.subscribe(m.joinInfo.sid, {
                        lts: r,
                        succ: !1,
                        video: e.subscribeOptions && e.subscribeOptions.video,
                        audio: e.subscribeOptions && e.subscribeOptions.audio,
                        peerid: e.getId() + "",
                        ec: be.NO_SUCH_REMOTE_STREAM
                    }))
                }, m.subscribeChange = function(e, t, i) {
                    var n = Date.now();
                    le.info("Gatewayclient ".concat(m.uid, " SubscribeChange ").concat(e.getId(), ": ").concat(JSON.stringify(e.subscribeOptions))), m._adjustPCMuteStatus(e), h(function(e, t) {
                        return {
                            _type: "subscribe_change",
                            options: Z()({
                                streamId: e
                            }, t)
                        }
                    }(e.getId(), e.subscribeOptions), function(o) {
                        if ("error" === o) return le.error("Subscribe Change Failed", e.getId()), void f(i, "SUBSCRIBE_CHANGE_FAILED");
                        var r = me({
                            type: "stream-subscribe-changed",
                            stream: m.remoteStreams[e.getId()]
                        });
                        ne.subscribe(m.joinInfo.sid, {
                            lts: n,
                            succ: !0,
                            video: e.subscribeOptions && e.subscribeOptions.video,
                            audio: e.subscribeOptions && e.subscribeOptions.audio,
                            peerid: e.getId() + "",
                            ec: null
                        }), m.dispatchEvent(r), t && t()
                    }, i)
                }, m._adjustPCMuteStatus = function(e) {
                    !e.local && e.pc && e.pc.peerConnection.getReceivers && e.pc.peerConnection.getReceivers().forEach(function(t) {
                        var i;
                        if (t && t.track && "audio" === t.track.kind) i = e.subscribeOptions ? e.audio && e.subscribeOptions.audio : e.audio, t.track.enabled = !!i;
                        else if (t && t.track && "video" === t.track.kind) {
                            var n;
                            n = e.subscribeOptions ? e.video && e.subscribeOptions.video : e.video, t.track.enabled = !!n
                        }
                    })
                }, m.unsubscribe = function(e, t, i) {
                    if ("object" !== c()(e) || null === e) return le.error("Invalid remote stream"), void f(i, be.INVALID_REMOTE_STREAM);
                    if (m.state !== d) return le.error("User is not in the session"), void f(i, be.INVALID_OPERATION);
                    if (void 0 != m.timers[e.getId()] && (clearInterval(m.timers[e.getId()]), clearInterval(m.timers[e.getId()] + "audio")), void 0 != m.audioLevel[e.getId()] && delete m.audioLevel[e.getId()], void 0 != m.timer_counter[e.getId()] && delete m.timer_counter[e.getId()], m.remoteStreams.hasOwnProperty(e.getId())) {
                        if (!m.socket) return le.error("User is not in the session"), void f(i, be.INVALID_OPERATION);
                        if (e.local) return le.error("Invalid remote stream"), void f(i, be.INVALID_REMOTE_STREAM);
                        e.close(), h(function(e) {
                            return {
                                _type: "unsubscribe",
                                message: e
                            }
                        }(e.getId()), function(n) {
                            if ("error" === n) return le.error("Unsubscribe remote stream failed", e.getId()), void f(i, be.UNSUBSCRIBE_STREAM_FAILED);
                            void 0 !== e.pc && (e.pc.close(), e.pc = void 0), e.onClose = void 0, e._onAudioMute = void 0, e._onAudioUnute = void 0, e._onVideoMute = void 0, e._onVideoUnmute = void 0, delete e.subscribeOptions, m.p2ps.delete(e.p2pId), le.info("Unsubscribe stream success"), t && t()
                        }, i)
                    } else f(i, be.NO_SUCH_REMOTE_STREAM)
                }, m.setRemoteVideoStreamType = function(e, t) {
                    if (le.debug("Switching remote video stream " + e.getId() + " to " + t), "object" === c()(e) && null !== e)
                        if (m.state === d) {
                            if (!e.local) {
                                switch (t) {
                                    case m.remoteVideoStreamTypes.REMOTE_VIDEO_STREAM_HIGH:
                                    case m.remoteVideoStreamTypes.REMOTE_VIDEO_STREAM_LOW:
                                    case m.remoteVideoStreamTypes.REMOTE_VIDEO_STREAM_MEDIUM:
                                        break;
                                    default:
                                        return
                                }
                                h(function(e, t) {
                                    return {
                                        _type: "switchVideoStream",
                                        message: {
                                            id: e,
                                            type: t
                                        }
                                    }
                                }(e.getId(), t), null, null)
                            }
                        } else le.error("User is not in the session");
                    else le.error("Invalid remote stream")
                }, m.renewToken = function(e, t, i) {
                    e ? m.key ? m.state !== d ? (le.debug("Client is not connected. Trying to rejoin"), m.key = e, m.rejoin(), t && t()) : (le.debug("renewToken from ".concat(m.key, " to ").concat(e)), h(function(e) {
                        return {
                            _type: "renew_token",
                            message: {
                                token: e
                            }
                        }
                    }(e), t, i)) : (le.error("Client is previously joined without token"), i && i(be.INVALID_PARAMETER)) : (le.error("Invalid Token ".concat(e)), i && i(be.INVALID_PARAMETER))
                }, m.setStreamFallbackOption = function(e, t) {
                    if (le.debug("Set stream fallback option " + e.getId() + " to " + t), "object" === c()(e) && null !== e)
                        if (m.state === d) {
                            if (!e.local) {
                                switch (t) {
                                    case m.streamFallbackTypes.STREAM_FALLBACK_OPTION_DISABLED:
                                    case m.streamFallbackTypes.STREAM_FALLBACK_OPTION_VIDEO_STREAM_LOW:
                                    case m.streamFallbackTypes.STREAM_FALLBACK_OPTION_AUDIO_ONLY:
                                        break;
                                    default:
                                        return
                                }
                                h(function(e, t) {
                                    return {
                                        _type: "setFallbackOption",
                                        message: {
                                            id: e,
                                            type: t
                                        }
                                    }
                                }(e.getId(), t), null, null)
                            }
                        } else le.error("User is not in the session");
                    else le.error("Invalid remote stream")
                }, m.startLiveStreaming = function(e, t) {
                    m.liveStreams.set(e, t), le.debug("Start live streaming " + e + " transcodingEnabled " + t), m.state === d ? h(function(e, t) {
                        return {
                            _type: "start_live_streaming",
                            message: {
                                url: e,
                                transcodingEnabled: t
                            }
                        }
                    }(e, t), null, null) : le.error("User is not in the session")
                }, m.stopLiveStreaming = function(e) {
                    le.debug("Stop live streaming " + e), m.state === d ? (m.liveStreams.delete(e), h(function(e) {
                        return {
                            _type: "stop_live_streaming",
                            message: {
                                url: e
                            }
                        }
                    }(e), null, null)) : le.error("User is not in the session")
                }, m.setLiveTranscoding = function(e) {
                    (function(e) {
                        var t = ["lowLatency", "userConfigExtraInfo", "transcodingUsers"];
                        for (var i in e)
                            if ("lowLatency" === i && "boolean" != typeof e[i] || "userConfigExtraInfo" === i && "object" !== c()(e[i]) || "transcodingUsers" === i && !j(e[i]) || !~t.indexOf(i) && "number" != typeof e[i]) throw new Error("Param [" + i + "] is inValid");
                        return !0
                    })(e) && (m.transcoding = e, le.debug("Set live transcoding ", e), m.state === d ? h(function(e) {
                        return {
                            _type: "set_live_transcoding",
                            message: {
                                transcoding: e
                            }
                        }
                    }(e), null, null) : le.error("User is not in the session"))
                }, m.addInjectStreamUrl = function(e, t) {
                    m.injectLiveStreams.set(e, t), le.debug("Add inject stream url " + e + " config ", t), m.state === d ? h(function(e, t) {
                        return {
                            _type: "add_inject_stream_url",
                            message: {
                                url: e,
                                config: t
                            }
                        }
                    }(e, t), null, null) : le.error("User is not in the session")
                }, m.removeInjectStreamUrl = function(e) {
                    le.debug("Remove inject stream url " + e), m.state === d ? (m.injectLiveStreams.delete(e), h(function(e) {
                        return {
                            _type: "remove_inject_stream_url",
                            message: {
                                url: e
                            }
                        }
                    }(e), null, null)) : le.error("User is not in the session")
                }, m.enableAudioVolumeIndicator = function(e, t) {
                    m.audioVolumeIndication.enabled = !0, m.audioVolumeIndication.interval = e, m.audioVolumeIndication.smooth = t, m.resetAudioVolumeIndication()
                }, m.resetAudioVolumeIndication = function() {
                    if (clearInterval(m.timers.audioVolumeIndication), clearInterval(m.timers.audioVolumeSampling), m.audioVolumeIndication.enabled && m.audioVolumeIndication.interval) {
                        var e = Math.floor(1e3 * m.audioVolumeIndication.smooth / 100);
                        m.timers.audioVolumeSampling = setInterval(function() {
                            m.audioVolumeSampling || (m.audioVolumeSampling = {});
                            var t = {};
                            for (var i in m.remoteStreams) {
                                var n = m.remoteStreams[i];
                                if (n.stream && n.hasAudio()) {
                                    var o = n.getAudioLevel();
                                    o > 0 && o < 1 && (o *= 100);
                                    var r = m.audioVolumeSampling[i] || [];
                                    for (r.push(o); r.length > e;) r.shift();
                                    t[i] = r
                                }
                            }
                            m.audioVolumeSampling = t
                        }, 100), m.timers.audioVolumeIndication = setInterval(function() {
                            var e = [];
                            for (var t in m.remoteStreams)
                                if (m.audioVolumeSampling && m.audioVolumeSampling[t]) {
                                    var i = m.audioVolumeSampling[t],
                                        n = 0;
                                    i.forEach(function(e) {
                                        n += e
                                    });
                                    var o = {
                                        uid: t,
                                        level: Math.floor(n / i.length)
                                    };
                                    o.level && e.push(o)
                                } var r = e.sort(function(e, t) {
                                return e.level - t.level
                            });
                            le.debug("volume-indicator", JSON.stringify(r)), m.audioVolumeIndication.sortedAudioVolumes = r;
                            var a = fe({
                                type: "volume-indicator",
                                attr: r
                            });
                            m.dispatchEvent(a)
                        }, m.audioVolumeIndication.interval)
                    }
                }, m.closeGateway = function() {
                    le.debug("close gateway"), m.state = a, m.socket.close(), v()
                };
                var v = function() {
                    for (var e in m.timers) m.timers.hasOwnProperty(e) && clearInterval(m.timers[e]);
                    for (var e in m.remoteStreams)
                        if (m.remoteStreams.hasOwnProperty(e)) {
                            var t = m.remoteStreams[e],
                                i = fe({
                                    type: "stream-removed",
                                    uid: t.getId(),
                                    stream: t
                                });
                            m.dispatchEvent(i)
                        } m.p2ps.clear(), E(), I(), clearInterval(m.pingTimer)
                };
                m.rejoin = function() {
                    m.socket && (clearInterval(m.pingTimer), m.socket.close(), m.socket = void 0), m.state = s, S()
                };
                var S = function(e, t) {
                        e = e || function(e) {
                            le.info("User " + e + " is re-joined to " + m.joinInfo.cname), m.dispatchEvent(fe({
                                type: "rejoin"
                            })), m.liveStreams && m.liveStreams.size && m.liveStreams.forEach(function(e, t) {
                                e && m.setLiveTranscoding(m.transcoding), m.startLiveStreaming(t, e)
                            }), m.injectLiveStreams && m.injectLiveStreams.size && m.injectLiveStreams.forEach(function(e, t) {
                                m.addInjectStreamUrl(t, e)
                            })
                        }, t = t || function(e) {
                            le.error("Re-join to channel failed [" + e + "]"), m.dispatchEvent(me({
                                type: "error",
                                reason: e
                            }))
                        }, m.key ? (++m.rejoinAttempt, m.join(m.joinInfo, m.key, e, t)) : le.error("Connection recover failed [Invalid channel key]")
                    },
                    _ = function(e, t, n) {
                        m.onConnect = t, void 0 !== m.socket ? (m.dispatchEvent({
                            type: "reconnect"
                        }), "retry" === m.reconnectMode ? (le.debug("Retry current gateway"), m.socket.reconnect()) : "tryNext" === m.reconnectMode ? (le.debug("Try next gateway"), m.socket.connectNext()) : "recover" === m.reconnectMode && (le.debug("Recover gateway"), le.debug("Try to reconnect choose server and get gateway list again "), mt(m.joinInfo, function(e) {
                            m.socket.replaceHost(e.gateway_addr)
                        }))) : (! function(e) {
                            m.socket = dt(e, {
                                sid: m.joinInfo.sid
                            })
                        }(e.gatewayAddr), m.socket.on("onUplinkStats", function(e) {
                            m.OutgoingAvailableBandwidth = e.uplink_available_bandwidth, m.localStreams[m.uid] && (m.localStreams[m.uid].uplinkStats = e)
                        }), m.socket.on("connect", function() {
                            m.dispatchEvent({
                                type: "connected"
                            }), m.attemps = 1, h(function(e) {
                                var t = e;
                                return e.uni_lbs_ip && (t = Z()(e, {
                                    wanip: e.uni_lbs_ip,
                                    hasChange: m.hasChangeBGPAddress
                                })), {
                                    _type: "token",
                                    message: t
                                }
                            }(e), m.onConnect, n)
                        }), m.socket.on("recover", function() {
                            m.state = s, le.debug("Try to reconnect choose server and get gateway list again "), mt(m.joinInfo, function(e) {
                                m.socket.replaceHost(e.gateway_addr)
                            })
                        }), m.socket.on("disconnect", function(e) {
                            if (m.state !== a) {
                                m.state = a;
                                var t = me({
                                    type: "error",
                                    reason: be.SOCKET_DISCONNECTED
                                });
                                if (m.dispatchEvent(t), 0 === m.p2ps.size ? m.reconnectMode = "tryNext" : m.reconnectMode = "retry", v(), 1 != i) {
                                    var n = function(e) {
                                        return 1e3 * Math.min(30, Math.pow(2, e) - 1)
                                    }(m.attemps);
                                    le.error("Disconnect from server [" + e + "], attempt to recover [#" + m.attemps + "] after " + n / 1e3 + " seconds");
                                    setTimeout(function() {
                                        m.attemps++, m.state = s, S()
                                    }, n)
                                }
                            }
                        }), m.socket.on("onAddAudioStream", function(e) {
                            if (le.info("Newly added audio stream with uid", e.id), m.remoteStreamsInChannel.has(e.id) || m.remoteStreamsInChannel.add(e.id), void 0 === m.remoteStreams[e.id]) {
                                var t = it({
                                    streamID: e.id,
                                    local: !1,
                                    audio: e.audio,
                                    video: e.video,
                                    screen: e.screen,
                                    attributes: e.attributes
                                });
                                m.remoteStreams[e.id] = t;
                                var i = me({
                                    type: "stream-added",
                                    stream: t
                                });
                                m.dispatchEvent(i)
                            }
                        }), m.socket.on("onUpdateStream", function(e) {
                            var t = m.remoteStreams[e.id];
                            if (t) {
                                delete e.id, t.audio = e.audio, t.video = e.video, t.screen = e.screen, t.pc && m._adjustPCMuteStatus(t);
                                var i = me({
                                    type: "stream-updated",
                                    stream: t
                                });
                                m.dispatchEvent(i)
                            } else le.debug("Ignoring onUpdateStream event before onAddStream for uid ".concat(e.id))
                        }), m.socket.on("onAddVideoStream", function(e) {
                            if (le.info("Newly added remote stream with uid" + e.id + "."), m.remoteStreamsInChannel.has(e.id) || m.remoteStreamsInChannel.add(e.id), void 0 === m.remoteStreams[e.id]) {
                                var t = it({
                                    streamID: e.id,
                                    local: !1,
                                    audio: e.audio,
                                    video: e.video,
                                    screen: e.screen,
                                    attributes: e.attributes
                                });
                                m.remoteStreams[e.id] = t;
                                var i = me({
                                    type: "stream-added",
                                    stream: t
                                });
                                m.dispatchEvent(i)
                            } else {
                                var n = m.remoteStreams[e.id];
                                if (void 0 !== n.stream) {
                                    if ((t = m.remoteStreams[e.id]).video = !0, t._unmuteVideo(), le.info("Stream changed: enable video " + e.id), t.isPlaying()) {
                                        var o = t.player.elementID;
                                        t.stop(), t.play(o)
                                    }
                                } else if (n.p2pId) m.remoteStreams[e.id].video = !0;
                                else {
                                    t = it({
                                        streamID: e.id,
                                        local: !1,
                                        audio: !0,
                                        video: !0,
                                        screen: !1,
                                        attributes: e.attributes
                                    });
                                    m.remoteStreams[e.id] = t, le.info("Stream changed: modify video " + e.id)
                                }
                            }
                        }), m.socket.on("onRemoveStream", function(e) {
                            m.remoteStreamsInChannel.has(e.id) && m.remoteStreamsInChannel.delete(e.id);
                            var t = m.remoteStreams[e.id];
                            if (t) {
                                delete m.remoteStreams[e.id];
                                var i = me({
                                    type: "stream-removed",
                                    stream: t
                                });
                                m.dispatchEvent(i), t.close(), void 0 !== t.pc && (t.pc.close(), t.pc = void 0, m.p2ps.delete(t.p2pId))
                            } else console.log("ERROR stream ", e.id, " not found onRemoveStream ", e)
                        }), m.socket.on("onPublishStream", function(e) {
                            var t = m.localStreams[e.id],
                                i = me({
                                    type: "streamPublished",
                                    stream: t
                                });
                            m.dispatchEvent(i)
                        }), m.socket.on("mute_audio", function(e) {
                            le.info("rcv peer mute audio:" + e.peerid);
                            var t = fe({
                                    type: "mute-audio",
                                    uid: e.peerid
                                }),
                                i = m.remoteStreams[e.peerid];
                            i && (i.audioEnabled = !1), m.dispatchEvent(t)
                        }), m.socket.on("unmute_audio", function(e) {
                            le.info("rcv peer unmute audio:" + e.peerid);
                            var t = fe({
                                    type: "unmute-audio",
                                    uid: e.peerid
                                }),
                                i = m.remoteStreams[e.peerid];
                            i && (i.audioEnabled = !0), m.dispatchEvent(t)
                        }), m.socket.on("mute_video", function(e) {
                            le.info("rcv peer mute video:" + e.peerid);
                            var t = fe({
                                    type: "mute-video",
                                    uid: e.peerid
                                }),
                                i = m.remoteStreams[e.peerid];
                            i && (i.videoEnabled = !1), m.dispatchEvent(t)
                        }), m.socket.on("unmute_video", function(e) {
                            le.info("rcv peer unmute video:" + e.peerid);
                            var t = fe({
                                    type: "unmute-video",
                                    uid: e.peerid
                                }),
                                i = m.remoteStreams[e.peerid];
                            i && (i.videoEnabled = !0), m.dispatchEvent(t)
                        }), m.socket.on("user_banned", function(e) {
                            le.info("user banned uid:" + e.id + "error:" + e.errcode);
                            var t = fe({
                                type: "client-banned",
                                uid: e.id,
                                attr: e.errcode
                            });
                            m.dispatchEvent(t), i = !0, leave()
                        }), m.socket.on("stream_fallback", function(e) {
                            le.info("stream fallback uid:" + e.id + " peerId:" + e.peerid + " type:" + e.type);
                            var t = fe({
                                type: "stream-fallback",
                                uid: e.id,
                                stream: e.peerid,
                                attr: e.type
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("stream_recover", function(e) {
                            le.info("stream recover uid:" + e.id + "peerId:" + e.peerid + " type:" + e.type);
                            var t = fe({
                                type: "stream-recover",
                                uid: e.id,
                                stream: e.peerid,
                                attr: e.type
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("onP2PLost", function(e) {
                            if (le.debug("p2plost:", e, "p2ps:", m.p2ps), "publish" === e.event) {
                                var t = m.localStreams[e.uid];
                                t && ne.publish(m.joinInfo.sid, {
                                    lts: t.publishLTS,
                                    succ: !1,
                                    audioName: t.hasAudio() && t.audioName,
                                    videoName: t.hasVideo() && t.videoName,
                                    screenName: t.hasScreen() && t.screenName,
                                    ec: "DTLS failed"
                                })
                            }
                            if ("subscribe" === e.event) {
                                var i = m.remoteStreams[e.uid];
                                i && ne.subscribe(m.joinInfo.sid, {
                                    lts: i.subscribeLTS,
                                    succ: !1,
                                    video: i.subscribeOptions && i.subscribeOptions.video,
                                    audio: i.subscribeOptions && i.subscribeOptions.audio,
                                    peerid: e.uid + "",
                                    ec: "DTLS failed"
                                })
                            }
                            le.debug("p2plost:", e.p2pid);
                            var n = m.p2ps.get(e.p2pid);
                            n && (m.p2ps.delete(e.p2pid), n.local ? m.dispatchEvent(fe({
                                type: "pubP2PLost",
                                stream: n
                            })) : m.remoteStreams[n.getId()] && m.dispatchEvent(fe({
                                type: "subP2PLost",
                                stream: n
                            })))
                        }), m.socket.on("onTokenPrivilegeWillExpire", function(e) {
                            le.debug("Received Message onTokenPrivilegeWillExpire"), m.dispatchEvent(fe({
                                type: "onTokenPrivilegeWillExpire"
                            }))
                        }), m.socket.on("onTokenPrivilegeDidExpire", function() {
                            le.warning("Received Message onTokenPrivilegeDidExpire, please get new token and join again"), m.dispatchEvent(fe({
                                type: "onTokenPrivilegeDidExpire"
                            })), m.closeGateway()
                        }), m._doWithAction = function(e, t, i) {
                            "tryNext" === e ? function(e, t) {
                                le.debug("Connect next gateway"), m.state = a, m.socket.close(), v(), m.reconnectMode = "tryNext", S(e, t)
                            }(t, i) : "retry" === e ? function(e, t) {
                                le.debug("Reconnect gateway"), m.state = a, m.socket.close(), v(), m.reconnectMode = "retry", S(e, t)
                            }(t, i) : "quit" === e ? (le.debug("quit gateway"), m.state = a, m.socket.close(), v()) : "recover" === e && (le.debug("Reconnect gateway"), m.state = a, m.socket.close(), v(), m.reconnectMode = "recover", S())
                        }, m.socket.on("notification", function(e) {
                            if (le.debug("Receive notification: ", e), "ERR_JOIN_BY_MULTI_IP" === ye[e.code]) return m.dispatchEvent({
                                type: "onMultiIP",
                                arg: e
                            });
                            e.detail ? m._doWithAction(ft[ye[e.code]]) : e.action && m._doWithAction(e.action)
                        }), m.socket.on("onPeerLeave", function(e) {
                            var t = fe({
                                type: "peer-leave",
                                uid: e.id
                            });
                            if (m.remoteStreamsInChannel.has(e.id) && m.remoteStreamsInChannel.delete(e.id), m.remoteStreams.hasOwnProperty(e.id) && (t.stream = m.remoteStreams[e.id]), m.dispatchEvent(t), m.remoteStreams.hasOwnProperty(e.id)) {
                                le.info("closing stream on peer leave", e.id);
                                var i = m.remoteStreams[e.id];
                                i.close(), delete m.remoteStreams[e.id], void 0 !== i.pc && (i.pc.close(), i.pc = void 0, m.p2ps.delete(i.p2pId))
                            }
                            m.timers.hasOwnProperty(e.id) && (clearInterval(m.timers[e.id]), clearInterval(m.timers[e.id] + "_RelatedStats"), delete m.timers[e.id]), void 0 != m.audioLevel[e.id] && delete m.audioLevel[e.id], void 0 != m.timer_counter[e.id] && delete m.timer_counter[e.id]
                        }), m.socket.on("onUplinkStats", function(e) {}), m.socket.on("liveStreamingStarted", function(e) {
                            var t = Se({
                                type: "liveStreamingStarted",
                                url: e.url
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("liveStreamingFailed", function(e) {
                            var t = Se({
                                type: "liveStreamingFailed",
                                url: e.url
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("liveStreamingStopped", function(e) {
                            var t = Se({
                                type: "liveStreamingStopped",
                                url: e.url
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("liveTranscodingUpdated", function(e) {
                            var t = Se({
                                type: "liveTranscodingUpdated",
                                reason: e.reason
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("streamInjectedStatus", function(e) {
                            var t = Se({
                                type: "streamInjectedStatus",
                                url: e.url,
                                uid: e.uid,
                                status: e.status
                            });
                            m.dispatchEvent(t)
                        }), m.socket.on("onUserOnline", function(e) {
                            m.dispatchEvent({
                                type: "peer-online",
                                uid: e.id
                            })
                        }))
                    },
                    h = function(e, t, i) {
                        if (void 0 === m.socket) return le.error("No socket available"), void f(i, be.INVALID_OPERATION);
                        try {
                            m.socket.emitSimpleMessage(e, function(e, n) {
                                "success" === e ? "function" == typeof t && t(n) : "function" == typeof i && i(ye[n] || n)
                            })
                        } catch (t) {
                            le.error("Socket emit message failed" + JSON.stringify(e)), le.error(t), f(i, be.SOCKET_ERROR)
                        }
                    },
                    y = function(e, t) {
                        if (void 0 !== m.socket) try {
                            m.socket.emitSimpleMessage(e, function(e, i) {
                                t && t(e, i)
                            })
                        } catch (e) {
                            le.error("Error in sendSimpleSdp [" + e + "]")
                        } else le.error("Error in sendSimpleSdp [socket not ready]")
                    },
                    I = function() {
                        for (var e in m.localStreams)
                            if (void 0 !== m.localStreams[e]) {
                                var t = m.localStreams[e];
                                delete m.localStreams[e], void 0 !== t.pc && (t.pc.close(), t.pc = void 0)
                            }
                    },
                    E = function() {
                        for (var e in m.remoteStreamsInChannel.clear(), m.remoteStreams)
                            if (m.remoteStreams.hasOwnProperty(e)) {
                                var t = m.remoteStreams[e];
                                t.isPlaying() && t.stop(), t.close(), delete m.remoteStreams[e], void 0 !== t.pc && (t.pc.close(), t.pc = void 0)
                            }
                    };
                return m
            },
            Et = {
                _gatewayClients: {},
                register: function(e, t) {
                    if (!t.uid) {
                        var i = "NO_UID_PROVIDED";
                        return le.error(i, t), i
                    }
                    if (t.cname) {
                        if (this._gatewayClients[t.cname] && this._gatewayClients[t.cname][t.uid] && this._gatewayClients[t.cname][t.uid] !== e) {
                            i = "UID_CONFLICT";
                            return le.error(i, t), i
                        }
                        return le.debug("register client Channel", t.cname, "Uid", t.uid), this._gatewayClients[t.cname] || (this._gatewayClients[t.cname] = {}), this._gatewayClients[t.cname][t.uid] = e, null
                    }
                    var i = "NO_CHANNEL_PROVIDED";
                    return le.error(i, t), i
                },
                unregister: function(e) {
                    var t = e && e.uid,
                        i = e.joinInfo && e.joinInfo.cname;
                    if (!t || !i) {
                        var n = "INVALID_GATEWAYCLIENT";
                        return le.error(n), n
                    }
                    if (this._gatewayClients[i] && this._gatewayClients[i][t]) {
                        if (this._gatewayClients[i][t] !== e) {
                            n = "GATEWAYCLIENT_UID_CONFLICT";
                            return le.error(n), n
                        }
                        return le.debug("unregister client ", e.uid), delete this._gatewayClients[i][t], null
                    }
                    var n = "GATEWEAY_CLIENT_UNREGISTERED";
                    le.error(n)
                }
            };
        It.DISCONNECTED = 0, It.CONNECTING = 1, It.CONNECTED = 2, It.DISCONNECTING = 3, It.connetionStateMap = {
            0: "DISCONNECTED",
            1: "CONNECTING",
            2: "CONNECTED",
            3: "DISCONNECTING"
        };
        var bt = It,
            At = function(e) {
                var t;
                switch (e) {
                    case "120p":
                    case "120p_1":
                        t = ["120p_1", "120p_1", "120p_1"];
                        break;
                    case "120p_3":
                        t = ["120p_3", "120p_3", "120p_3"];
                        break;
                    case "180p":
                    case "180p_1":
                        t = ["90p_1", "90p_1", "180p_1"];
                        break;
                    case "180p_3":
                        t = ["120p_3", "120p_3", "180p_3"];
                        break;
                    case "180p_4":
                        t = ["120p_1", "120p_1", "180p_4"];
                        break;
                    case "240p":
                    case "240p_1":
                        t = ["120p_1", "120p_1", "240p_1"];
                        break;
                    case "240p_3":
                        t = ["120p_3", "120p_3", "240p_3"];
                        break;
                    case "240p_4":
                        t = ["120p_4", "120p_4", "240p_4"];
                        break;
                    case "360p":
                    case "360p_1":
                    case "360p_4":
                    case "360p_9":
                    case "360p_10":
                    case "360p_11":
                        t = ["90p_1", "90p_1", "360p_1"];
                        break;
                    case "360p_3":
                    case "360p_6":
                        t = ["120p_3", "120p_3", "360p_3"];
                        break;
                    case "360p_7":
                    case "360p_8":
                        t = ["120p_1", "120p_1", "360p_7"];
                        break;
                    case "480p":
                    case "480p_1":
                    case "480p_2":
                    case "480p_4":
                    case "480p_10":
                        t = ["120p_1", "120p_1", "480p_1"];
                        break;
                    case "480p_3":
                    case "480p_6":
                        t = ["120p_3", "120p_3", "480p_3"];
                        break;
                    case "480p_8":
                    case "480p_9":
                        t = ["120p_4", "120p_4", "480p_8"];
                        break;
                    case "720p":
                    case "720p_1":
                    case "720p_2":
                    case "720p_3":
                        t = ["90p_1", "90p_1", "720p_1"];
                        break;
                    case "720p_5":
                    case "720p_6":
                        t = ["120p_1", "120p_1", "720p_5"];
                        break;
                    case "1080p":
                    case "1080p_1":
                    case "1080p_2":
                    case "1080p_3":
                    case "1080p_5":
                        t = ["90p_1", "90p_1", "1080p_1"];
                        break;
                    case "1440p":
                    case "1440p_1":
                    case "1440p_2":
                        t = ["90p_1", "90p_1", "1440p_1"];
                        break;
                    case "4k":
                    case "4k_1":
                    case "4k_3":
                        t = ["90p_1", "90p_1", "4k_1"];
                        break;
                    default:
                        t = ["120p_1", "120p_1", "360p_7"]
                }
                return g() ? [e, 15, 50] : p() ? [t[1], 15, 100] : l() ? [t[2], 15, 50] : [t[0], 15, 50]
            },
            Rt = {
                1001: "FRAMERATE_INPUT_TOO_LOW",
                1002: "FRAMERATE_SENT_TOO_LOW",
                1003: "SEND_VIDEO_BITRATE_TOO_LOW",
                1005: "RECV_VIDEO_DECODE_FAILED",
                2001: "AUDIO_INPUT_LEVEL_TOO_LOW",
                2002: "AUDIO_OUTPUT_LEVEL_TOO_LOW",
                2003: "SEND_AUDIO_BITRATE_TOO_LOW",
                2005: "RECV_AUDIO_DECODE_FAILED",
                3001: "FRAMERATE_INPUT_TOO_LOW_RECOVER",
                3002: "FRAMERATE_SENT_TOO_LOW_RECOVER",
                3003: "SEND_VIDEO_BITRATE_TOO_LOW_RECOVER",
                3005: "RECV_VIDEO_DECODE_FAILED_RECOVER",
                4001: "AUDIO_INPUT_LEVEL_TOO_LOW_RECOVER",
                4002: "AUDIO_OUTPUT_LEVEL_TOO_LOW_RECOVER",
                4003: "SEND_AUDIO_BITRATE_TOO_LOW_RECOVER",
                4005: "RECV_AUDIO_DECODE_FAILED_RECOVER"
            },
            Tt = {
                FramerateInput: 1001,
                FramerateSent: 1002,
                SendVideoBitrate: 1003,
                VideoDecode: 1005,
                AudioIntputLevel: 2001,
                AudioOutputLevel: 2002,
                SendAudioBitrate: 2003,
                AudioDecode: 2005
            },
            Ct = function(e) {
                var t = {
                    remoteStreamStorage: {},
                    localStreamStorage: {}
                };
                return t.gatewayClient = e, t.checkAudioOutputLevel = function(e) {
                    return !(e && parseInt(e.audioRecvBytesDelta) > 0 && parseInt(e.audioDecodingNormalDelta) > 0 && 0 === parseInt(e.audioOutputLevel))
                }, t.checkAudioIntputLevel = function(e) {
                    return !e || 0 !== parseInt(e.audioInputLevel)
                }, t.checkFramerateInput = function(e, t) {
                    if (!e || !t.attributes) return !0;
                    var i = parseInt(t.attributes.maxFrameRate),
                        n = parseInt(e.googFrameRateInput);
                    return !i || !n || !(i > 10 && n < 5 || i < 10 && i >= 5 && n <= 1)
                }, t.checkFramerateSent = function(e) {
                    return !(e && parseInt(e.googFrameRateInput) > 5 && parseInt(e.googFrameRateSent) <= 1)
                }, t.checkSendVideoBitrate = function(e) {
                    return !e || 0 !== parseInt(e.videoSendBytesDelta)
                }, t.checkSendAudioBitrate = function(e) {
                    return !e || 0 !== parseInt(e.audioSendBytesDelta)
                }, t.checkVideoDecode = function(e) {
                    return !e || 0 === parseInt(e.videoRecvBytesDelta) || 0 !== parseInt(e.googFrameRateDecoded)
                }, t.checkAudioDecode = function(e) {
                    return !e || 0 === parseInt(e.audioRecvBytesDelta) || 0 !== parseInt(e.audioDecodingNormalDelta)
                }, t.record = function(e, i, n, o, r) {
                    n[e] || (n[e] = {
                        isPrevNormal: !0,
                        record: []
                    });
                    var a = n[e],
                        s = t["check" + e](i, r);
                    if (a.record.push(s), a.record.length >= 5) {
                        a.isCurNormal = a.record.includes(!0);
                        var d = Tt[e];
                        a.isPrevNormal && !a.isCurNormal && t.gatewayClient.dispatchEvent({
                            type: "exception",
                            code: d,
                            msg: Rt[d],
                            uid: o
                        }), !a.isPrevNormal && a.isCurNormal && t.gatewayClient.dispatchEvent({
                            type: "exception",
                            code: d + 2e3,
                            msg: Rt[d + 2e3],
                            uid: o
                        }), a.isPrevNormal = a.isCurNormal, a.record = []
                    }
                }, t.setLocalStats = function(e) {
                    var i = {};
                    Object.keys(e).map(function(n) {
                        var o = e[n],
                            r = t.gatewayClient.localStreams[parseInt(n)],
                            a = t.localStreamStorage[n] || {};
                        r && r.hasVideo() && (t.record("SendVideoBitrate", o.videoStats, a, n), t.record("FramerateInput", o.videoStats, a, n, r), t.record("FramerateSent", o.videoStats, a, n)), r && r.hasAudio() && (t.record("AudioIntputLevel", o.audioStats, a, n), t.record("SendAudioBitrate", o.audioStats, a, n)), i[n] = a
                    }), t.localStreamStorage = i
                }, t.setRemoteStats = function(i) {
                    var n = {};
                    Object.keys(i).map(function(o) {
                        var r = i[o],
                            a = e.remoteStreams[o],
                            s = t.remoteStreamStorage[o] || {};
                        a && a.hasVideo() && a.isPlaying() && t.record("VideoDecode", r.videoStats, s, o), a && a.hasAudio() && a.isPlaying() && (t.record("AudioOutputLevel", r.audioStats, s, o), t.record("AudioDecode", r.audioStats, s, o)), n[o] = s
                    }), t.remoteStreamStorage = n
                }, t
            },
            Nt = new function() {
                var e = pe();
                return e.states = {
                    UNINIT: "UNINIT",
                    INITING: "INITING",
                    INITED: "INITED"
                }, e.state = e.states.UNINIT, e.type = null, e.lastConnectedAt = null, e.lastDisconnectedAt = null, e.lastTypeChangedAt = null, e.networkChangeTimer = null, e._init = function(t, i) {
                    if (e.state = e.states.INITING, navigator.connection && navigator.connection.addEventListener) {
                        var n = e._getNetworkInfo();
                        e.type = n && n.type, e.state = e.states.INITED, t && t()
                    } else e.state = e.states.UNINIT, i && i("DO_NOT_SUPPORT")
                }, e._getNetworkInfo = function() {
                    return navigator.connection
                }, e._reloadNetworkInfo = function() {
                    var t = e._getNetworkInfo(),
                        i = t && t.type || "UNSUPPORTED",
                        n = Date.now();
                    if (i !== e.type) {
                        e.lastTypeChangedAt = n, "none" == i ? e.lastDisconnectedAt = n : "none" == e.type && (e.lastConnectedAt = n), e.type = i;
                        var o = {
                            type: "networkTypeChanged",
                            networkType: i
                        };
                        e.dispatchEvent(o)
                    }
                }, e.getStats = function(t, i) {
                    var n = {},
                        o = e._getNetworkInfo();
                    o && (n.NetworkType = o.type || "UNSUPPORTED"), setTimeout(function() {
                        t(n)
                    }, 0)
                }, e._init(function() {
                    navigator.connection.addEventListener("change", function() {
                        e._reloadNetworkInfo()
                    }), e.networkChangeTimer = setInterval(function() {
                        e._reloadNetworkInfo()
                    }, 5e3)
                }, function(e) {}), e
            },
            wt = function() {};
        wt.prototype.set = function(e, t) {
            ["BatteryLevel"].indexOf(e) > -1 && (this[e] = t)
        };
        var Ot = new function() {
                var e = pe();
                return e.states = {
                    UNINIT: "UNINIT",
                    INITING: "INITING",
                    INITED: "INITED"
                }, e.state = e.states.UNINIT, e.batteryManager = null, e._init = function(t, i) {
                    e.state = e.states.INITING, navigator.getBattery ? navigator.getBattery().then(function(i) {
                        e.batteryManager = i, t && setTimeout(function() {
                            t()
                        }, 0)
                    }).catch(function(e) {
                        le.debug("navigator.getBattery is disabled", e), t && t()
                    }) : (e.state = e.states.INITED, t && t())
                }, e._getBatteryStats = function() {
                    var t = {};
                    return e.batteryManager && e.batteryManager.level ? t.BatteryLevel = Math.floor(100 * e.batteryManager.level) : t.BatteryLevel = "UNSUPPORTED", t
                }, e.getStats = function(t, i) {
                    var n = new wt,
                        o = e._getBatteryStats();
                    o && o.BatteryLevel && n.set("BatteryLevel", o.BatteryLevel), t && t(n)
                }, e._init(), e
            },
            Dt = function(e) {
                var t = {
                    key: void 0,
                    highStream: null,
                    lowStream: null,
                    lowStreamParameter: null,
                    isDualStream: !1,
                    highStreamState: 2,
                    lowStreamState: 2,
                    proxyServer: null,
                    turnServer: {},
                    useProxyServer: !1
                };
                t.mode = e.mode;
                e = Z()({}, e);
                return t.aespassword = null, t.aesmode = "none", t.hasPublished = !1, t.getConnectionState = function() {
                    return bt.connetionStateMap[t.gatewayClient.state]
                }, t.setClientRole = function(i, n) {
                    He(i, "setClientRole", ["host", "audience"]);
                    var o = ne.reportApiInvoke(e.sessionId, {
                        name: "setClientRole",
                        callback: n
                    });
                    if ("rtc" === t.mode) {
                        var r = "RTC mode can not use setClientRole";
                        return le.warning(r), o && o(r)
                    }
                    t.gatewayClient && t.gatewayClient.state === bt.CONNECTED ? ("audience" === i && (0 === this.highStreamState ? this._unpublish(this.highStream, function() {
                        o && o(null, {
                            role: i
                        })
                    }, function(e) {
                        o && o(e)
                    }) : t.gatewayClient.setClientRole("audience", o)), "host" === i && t.gatewayClient.setClientRole("host", o)) : (t.gatewayClient.role = i, o && o(null, {
                        role: i
                    }))
                }, t.getGatewayInfo = function(e) {
                    if (t.gatewayClient.state !== bt.CONNECTED) {
                        var i = "Client is not in connected state";
                        return le.error(i), void e(i)
                    }
                    t.gatewayClient.getGatewayInfo(function(t) {
                        e(null, t)
                    }, e)
                }, t.renewToken = function(e, i, n) {
                    if (!Xe(e)) throw new Error("Invalid token: Token is of the string type .Length of the string: [1,255]. ASCII characters only.");
                    t.gatewayClient || (le.error("renewToken Failed. GatewayClient not Exist"), F(n, be.INVALID_OPERATION)), t.key ? (t.key = e, t.gatewayClient.renewToken(e, i, n)) : (le.error("renewToken should not be called before user join"), F(n, be.INVALID_OPERATION))
                }, t.setLowStreamParameter = function(e) {
                    Ge(e, "param");
                    var i = e.width,
                        n = e.height,
                        o = e.framerate,
                        r = e.bitrate;
                    tt(i) || Je(i, "width"), tt(n) || Je(n, "height"), tt(o) || Je(o, "framerate"), tt(r) || Je(r, "bitrate", 1, 1e7), (!i && n || i && !n) && le.warning("The width and height parameters take effect only when both are set"), t.lowStreamParameter = e
                }, t.init = function(t, i, n) {
                    ze(t), navigator.userAgent.match(/chrome\/[\d]./i) && function() {
                        var e = navigator.userAgent.match(/chrome\/[\d]./i);
                        return e && e[0] && e[0].split("/")[1]
                    }() <= 48 ? n ? n(be.BAD_ENVIRONMENT) : function() {
                        if (!document.getElementById("agora-ban-tip")) {
                            var e = document.createElement("div");
                            e.id = "agora-ban-tip", e.style = "position: absolute; width: 100%; height: 100%; display: flex; justify-content: center; align-items: center; color: #fff;", document.querySelector("body").prepend(e);
                            var t = document.createElement("div");
                            t.style = "background: #000; width: 346px; height: 116px; z-index: 100000; opacity: 0.6; border-radius: 10px; box-shadow: 0 2px 4px #000;", e.append(t);
                            var i = document.createElement("div");
                            i.style = "height: 76px; display: flex; justify-content: center; align-items: center;";
                            var n = document.createElement("span");
                            n.style = "height: 28px; width: 28px; color: #000; text-align: center; line-height: 30px; background: #fff; border-radius: 50%; font-weight: 600; font-size: 20px;margin-right: 5px;", n.innerText = "!";
                            var o = document.createElement("span");
                            o.innerText = "This browser does not support webRTC", i.append(n), i.append(o);
                            var r = document.createElement("div");
                            r.style = "height: 38px; display: flex; border-top: #fff 1px solid; justify-content: center; align-items: center;", r.innerText = "OK", t.append(i), t.append(r), r.onclick = function() {
                                var e = document.getElementById("agora-ban-tip");
                                e.parentNode.removeChild(e)
                            }
                        }
                    }() : (le.info("Initializing AgoraRTC client, appId: " + t + "."), e.appId = t, e.sessionId = h()().replace(/-/g, "").toUpperCase(), i && i())
                }, t.setTurnServer = function(e, i, n) {
                    if (t.gatewayClient && t.gatewayClient.state !== bt.DISCONNECTED) throw new Error("Set turn server before join channel");
                    if (t.useProxyServer) throw new Error("You have already set the proxy");
                    Ge(e, "turnServer");
                    var o = e.turnServerURL,
                        r = e.username,
                        a = e.password,
                        s = e.udpport,
                        d = e.forceturn,
                        c = e.tcpport;
                    ze(o, "turnServerURL"), ze(r, "username"), ze(a, "password"), ze(s, "udpport"), tt(d) || Ke(d, "forceturn"), t.turnServer.url = o, t.turnServer.udpport = s, t.turnServer.username = r, t.turnServer.credential = a, t.turnServer.forceturn = d || !1, tt(c) || (ze(c, "tcpport"), t.turnServer.tcpport = c, le.info("Set turnserver tcpurl." + t.turnServer.url + ":" + t.turnServer.tcpport)), le.info("Set turnserver udpurl." + t.turnServer.url + ":" + t.turnServer.udpport + ",username:" + t.turnServer.uername + ",password:" + t.turnServer.credential)
                }, t.setProxyServer = function(e) {
                    if (t.gatewayClient && t.gatewayClient.state !== bt.DISCONNECTED) throw new Error("Set proxy server before join channel");
                    if (!e) throw new Error("Do not set the proxyServer parameter as empty");
                    if (t.useProxyServer) throw new Error("You have already set the proxy");
                    ze(e, "proxyServer"), t.proxyServer = e, ne.setProxyServer(e), le.setProxyServer(e)
                }, t.startProxyServer = function() {
                    if (t.gatewayClient && t.gatewayClient.state !== bt.DISCONNECTED) throw new Error("Start proxy server before join channel");
                    if (t.proxyServer || t.turnServer.url) throw new Error("You have already set the proxy");
                    t.useProxyServer = !0
                }, t.stopProxyServer = function() {
                    if (t.gatewayClient && t.gatewayClient.state !== bt.DISCONNECTED) throw new Error("Stop proxy server after leave channel");
                    ne.setProxyServer(), le.setProxyServer(), t.turnServer = {}, t.proxyServer = null, t.useProxyServer = !1
                }, t.setEncryptionSecret = function(e) {
                    ze(e, "password"), t.aespassword = e
                }, t.setEncryptionMode = function(e) {
                    if (ze(e, "encryptionMode"), !rt.includes(e)) throw new Error('Invalid encryptionMode: encryptionMode should be "aes-128-xts" | "aes-256-xts" | "aes-128-ecb"');
                    t.aesmode = e
                }, t.configPublisher = function(e) {
                    Ge(e, "config");
                    var i = e.width,
                        n = e.height,
                        o = e.framerate,
                        r = e.bitrate,
                        a = e.publisherUrl;
                    Je(i, "width"), Je(n, "height"), Je(o, "framerate"), Je(r, "bitrate", 1, 1e7), a && ze(a, "publisherUrl"), t.gatewayClient.configPublisher(e)
                }, t.enableDualStream = function(i, n) {
                    return "iOS" === v() ? (ne.streamSwitch(e.sessionId, {
                        lts: (new Date).getTime(),
                        isdual: !0,
                        succ: !1
                    }), n && n(be.IOS_NOT_SUPPORT)) : m() ? (ne.streamSwitch(e.sessionId, {
                        lts: (new Date).getTime(),
                        isdual: !0,
                        succ: !1
                    }), n && n(be.WECHAT_NOT_SUPPORT)) : (ne.streamSwitch(e.sessionId, {
                        lts: (new Date).getTime(),
                        isdual: !0,
                        succ: !0
                    }), t.isDualStream = !0, void(0 === t.highStreamState ? t._publishLowStream(i, function(e) {
                        le.warning(e), n && n(be.ENABLE_DUALSTREAM_FAILED)
                    }) : 1 === t.highStreamState ? n && n(be.STILL_ON_PUBLISHING) : i && i()))
                }, t.disableDualStream = function(i, n) {
                    ne.streamSwitch(e.sessionId, {
                        lts: (new Date).getTime(),
                        isdual: !1,
                        succ: !0
                    }), t.isDualStream = !1, 0 === t.highStreamState ? t._unpublishLowStream(function() {
                        t.highStream.lowStream = null, i && i()
                    }, function(e) {
                        le.warning(e), n && n(be.DISABLE_DUALSTREAM_FAILED)
                    }) : 1 === t.highStreamState ? n && n(be.STILL_ON_PUBLISHING) : i && i()
                }, t._createLowStream = function(e, i) {
                    if (t.highStream && t.highStream.stream) {
                        var n = Z()({}, t.highStream.params);
                        if (n.streamID += 1, n.audio = !1, n.video) {
                            var o = t.highStream.stream.getVideoTracks()[0];
                            o ? je.getVideoCameraIdByLabel(o.label, function(r) {
                                n.cameraId = r;
                                var a = new it(n);
                                if (a.streamId = t.highStream.getId() + 1, t.lowStreamParameter) {
                                    var d = Z()({}, t.lowStreamParameter);
                                    if (!d.width || !d.height) {
                                        var c = At(t.highStream.profile),
                                            u = s[c[0]];
                                        d.width = u[0], d.height = u[1]
                                    }
                                    if (d.framerate = d.framerate || 5, d.bitrate = d.bitrate || 50, l() || g()) {
                                        le.debug("Shimming lowStreamParameter");
                                        u = s[t.highStream.profile];
                                        d.width = u[0], d.height = u[1]
                                    }
                                    a.setVideoProfileCustomPlus(d)
                                } else a.setVideoProfileCustom(At(t.highStream.profile));
                                a.init(function() {
                                    t.highStream.lowStream = a, o.enabled || a._muteVideo(), e && e(a)
                                }, i)
                            }, i) : i && i(be.HIGH_STREAM_NOT_VIDEO_TRACE)
                        } else i && i(be.HIGH_STREAM_NOT_VIDEO_TRACE)
                    } else i && i(be.HIGH_STREAM_NOT_VIDEO_TRACE)
                }, t._getLowStream = function(e, i) {
                    t.lowStream ? e(t.lowStream) : t._createLowStream(function(i) {
                        t.lowStream = i, e(t.lowStream)
                    }, i)
                }, t._publishLowStream = function(e, i) {
                    return 2 !== t.lowStreamState ? i && i(be.LOW_STREAM_ALREADY_PUBLISHED) : t.highStream && t.highStream.hasScreen() ? i && i(be.SHARING_SCREEN_NOT_SUPPORT) : void t._getLowStream(function(n) {
                        t.lowStreamState = 1, t.gatewayClient.publish(n, function() {
                            t.lowStreamState = 0, e && e()
                        }, function(e) {
                            le.debug("publish low stream failed"), i && i(e)
                        })
                    }, i)
                }, t._unpublishLowStream = function(e, i) {
                    if (0 !== t.lowStreamState) return i && i(be.LOW_STREAM_NOT_YET_PUBLISHED);
                    t.lowStream && (t.gatewayClient.unpublish(t.lowStream, function() {}, function(e) {
                        le.debug("unpublish low stream failed"), i && i(e)
                    }), t.lowStream.close(), t.lowStream = null, t.lowStreamState = 2, e && e())
                }, t.join = function(i, n, o, r, a) {
                    if (i && !Xe(i)) return le.warning("Param channelKey should be string"), a && a(be.INVALID_PARAMETER);
                    if (! function(e) {
                            return et(e) && /^[a-zA-Z0-9!#$%&()+-:;<=.>?@[\]^_{}|~,\s]{1,64}$/.test(e)
                        }(n)) return le.warning("The length must be within 64 bytes. The supported characters: a-z,A-Z,0-9,space,!, #, $, %, &, (, ), +, -, :, ;, <, =, ., >, ?, @, [, ], ^, _,  {, }, |, ~, ,"), a && a(be.INVALID_PARAMETER);
                    if ("string" == typeof n && "" === n) return le.warning("Param channel should not be empty"), a && a(be.INVALID_PARAMETER);
                    if (o && !W(o) && !Ye(o, 1, 255)) return le.warning("[String uid] Length of the string: [1,255]. ASCII characters only. [Number uid] The value range is [0,10000]"), a && a(be.INVALID_PARAMETER);
                    if ("string" == typeof o && 0 == o.length) return le.warning("String uid should not be empty"), a && a(be.INVALID_PARAMETER);
                    if ("string" == typeof o && o.length > 256) return le.warning("Length of string uid should be less than 255"), a && a(be.INVALID_PARAMETER);
                    t.highStream = null, t.lowStream = null, t.lowStreamParameter = null, t.isDualStream = !1, t.highStreamState = 2, t.lowStreamState = 2;
                    var s = {
                        appId: e.appId,
                        sid: e.sessionId,
                        cname: n,
                        uid: o,
                        turnServer: t.turnServer,
                        proxyServer: t.proxyServer,
                        token: i || e.appId,
                        useProxyServer: t.useProxyServer
                    };
                    if ("string" == typeof o && (s.stringUid = o, s.uid = 0), t.aespassword && "none" !== t.aesmode && Z()(s, {
                            aespassword: t.aespassword,
                            aesmode: t.aesmode
                        }), ne.sessionInit(e.sessionId, {
                            lts: (new Date).getTime(),
                            cname: n,
                            appid: e.appId,
                            mode: e.mode,
                            succ: !0
                        }), t.onSuccess = r, t.onFailure = a, t.channel = n, t.gatewayClient.state !== bt.DISCONNECTED) return le.error("Client already in connecting/connected state"), a && a(be.INVALID_OPERATION), void ne.joinGateway(s.sid, {
                        lts: Date.now(),
                        succ: !1,
                        ec: be.INVALID_OPERATION,
                        addr: null
                    });
                    t.gatewayClient.state = bt.CONNECTING, mt(s, function(o) {
                        le.info("Joining channel: " + n), t.key = i || e.appId, s.cid = o.cid, s.uid = o.uid, o.uni_lbs_ip && o.uni_lbs_ip[1] && (s.uni_lbs_ip = o.uni_lbs_ip[1]), s.gatewayAddr = o.gateway_addr, t.joinInfo = s, t.gatewayClient.join(s, t.key, function(e) {
                            le.info("Join channel " + n + " success, join with uid: " + e + "."), t.onSuccess = null, r && r(e)
                        }, a)
                    })
                }, t.renewChannelKey = function(e, i, n) {
                    ze(e, "key", 1, 2047), void 0 === t.key ? (le.error("renewChannelKey should not be called before user join"), F(n, be.INVALID_OPERATION)) : (t.key = e, t.gatewayClient.key = e, t.gatewayClient.rejoin(), F(i))
                }, t.leave = function(e, i) {
                    le.info("Leaving channel"), t.gatewayClient.leave(e, i)
                }, t._publish = function(i, n, o) {
                    if (2 !== t.highStreamState) return le.warning("Can't publish stream when stream already publish", i.getId()), o && o(be.STREAM_ALREADY_PUBLISHED);
                    le.info("Publishing stream, uid: ", i.getId()), t.highStream = i, t.highStreamState = 1, t.highStream.streamId = t.joinInfo.stringUid || t.joinInfo.uid, t.hasPublished = !1;
                    var r = function(i, n, o) {
                        t.gatewayClient.publish(i, function() {
                            i.sid = e.sessionId, t.highStreamState = 0, le.info("Publish success, uid:", i.getId()), t.isDualStream ? t._publishLowStream(function() {
                                n && n()
                            }, function(e) {
                                le.warning(e), n && n()
                            }) : n && n()
                        }, o)
                    };
                    "audience" === t.gatewayClient.role && "live" === t.mode ? t.gatewayClient.setClientRole("host", function(e) {
                        if (e) return o && o(e);
                        r(i, n, o)
                    }) : r(i, n, o)
                }, t._unpublish = function(e, i, n) {
                    if (0 !== t.highStreamState) return le.warning("Can't unpublish stream when stream not publish"), n && n(be.STREAM_NOT_YET_PUBLISHED);
                    le.info("Unpublish stream, uid: ", e.getId());
                    var o = function(e, i, n) {
                        t.isDualStream && t.lowStream ? (t._unpublishLowStream(null, n), t.gatewayClient.unpublish(e, null, n), t.highStreamState = 2, le.info("Unpublish stream success, uid:", e.getId())) : (t.gatewayClient.unpublish(e, null, n), t.highStreamState = 2, le.info("Unpublish stream success, uid:", e.getId())), i && i()
                    };
                    "host" === t.gatewayClient.role && "live" === t.mode ? t.gatewayClient.setClientRole("audience", function(t) {
                        if (t) return n && n(t);
                        o(e, i, n)
                    }) : o(e, i, n)
                }, t.publish = function(e, i) {
                    2 === t.highStreamState ? t._publish(e, null, i) : i && i(be.STREAM_ALREADY_PUBLISHED)
                }, t.unpublish = function(e, i) {
                    0 === t.highStreamState ? t._unpublish(e, null, i) : i && i(be.STREAM_NOT_YET_PUBLISHED)
                }, t.subscribe = function(i, n, o) {
                    "function" == typeof n && (o = n, n = null), Ge(i, "stream"), tt(n) || (Ge(n, "options"), tt(n.video) || Ke(n.video, "options.video"), tt(n.audio) || Ke(n.audio, "options.audio"));
                    var r = ne.reportApiInvoke(e.sessionId, {
                            callback: function(e) {
                                if (e) return o && o(e)
                            },
                            name: "subscribe",
                            options: n
                        }),
                        a = {
                            video: !0,
                            audio: !0
                        };
                    if (!tt(n)) {
                        if (l() && (!n.video || !n.audio)) {
                            var s = "SAFARI_NOT_SUPPORTED_FOR_TRACK_SUBSCRIPTION";
                            return le.error(s), void(o && o(s))
                        }
                        if (!tt(n.video) && !Qe(n.video) || !tt(n.audio) && !Qe(n.audio) || !1 === n.audio && !1 === n.video) {
                            s = "INVALID_PARAMETER ".concat(JSON.stringify(n));
                            return le.error(s), void(o && o(s))
                        }
                    }
                    if ("object" !== c()(n)) {
                        var d = "InvalidParameter: SubscribeOptions type " + c()(n);
                        return le.error(d), o(d)
                    }
                    i.subscribeOptions ? (Z()(i.subscribeOptions, a, n), t.gatewayClient.subscribeChange(i, r, r)) : (i.subscribeOptions = Z()({}, a, n), t.gatewayClient.subscribe(i, r, r))
                }, t.unsubscribe = function(e, i) {
                    le.info("Unsubscribe stream, uid: ", e.getId()), t.gatewayClient.unsubscribe(e, null, i)
                }, t.setRemoteVideoStreamType = function(e, i) {
                    He(i, "streamType", [0, 1]), t.gatewayClient.setRemoteVideoStreamType(e, i)
                }, t.setStreamFallbackOption = function(e, i) {
                    He(i, "fallbackType", [0, 1, 2]), t.gatewayClient.setStreamFallbackOption(e, i)
                }, t.startLiveStreaming = function(e, i) {
                    ze(e, "url"), tt(i) || Ke(i, "transcodingEnabled"), t.gatewayClient.startLiveStreaming(e, i)
                }, t.stopLiveStreaming = function(e) {
                    ze(e, "url"), t.gatewayClient.stopLiveStreaming(e)
                }, t.setLiveTranscoding = function(e) {
                    Ge(e, "transcoding");
                    var i = e.width,
                        n = e.height,
                        o = e.videoBitrate,
                        r = e.videoFramerate,
                        a = e.lowLatency,
                        s = e.audioSampleRate,
                        d = e.audioBitrate,
                        c = e.audioChannels,
                        u = e.videoGop,
                        l = e.videoCodecProfile,
                        p = e.userCount,
                        g = e.backgroundColor,
                        m = e.transcodingUsers;
                    if (tt(i) || Je(i, "width"), tt(n) || Je(n, "height"), tt(o) || Je(o, "videoBitrate", 1, 1e6), tt(r) || Je(r, "videoFramerate"), tt(a) || Ke(a, "lowLatency"), tt(s) || He(s, "audioSampleRate", [32e3, 44100, 48e3]), tt(d) || Je(d, "audioBitrate", 1, 128), tt(c) || He(c, "audioChannels", [1, 2, 3, 4, 5]), tt(u) || Je(u, "videoGop"), tt(l) || He(l, "videoCodecProfile", [66, 77, 100]), tt(p) || Je(p, "userCount", 0, 17), tt(g) || Je(g, "backgroundColor", 0, 16777215), !tt(m)) {
                        if (! function(e) {
                                return e instanceof Array
                            }(m)) throw new Error("[transcodingUsers]: transcodingUsers should be Array");
                        if (m.length > 17) throw new Error("The length of transcodingUsers cannot greater than 17");
                        m.map(function(e, t) {
                            if (!tt(e.uid) && !W(e.uid) && !Ye(e.uid, 1, 255)) throw new Error("[String uid] Length of the string: [1,255]. ASCII characters only. [Number uid] The value range is [0,10000]");
                            if (tt(e.x) || Je(e.x, "transcodingUser[".concat(t, "].x"), 0, 1e4), tt(e.y) || Je(e.y, "transcodingUser[".concat(t, "].y"), 0, 1e4), tt(e.width) || Je(e.width, "transcodingUser[".concat(t, "].width"), 0, 1e4), tt(e.height) || Je(e.height, "transcodingUser[".concat(t, "].height"), 0, 1e4), tt(e.zOrder) || Je(e.zOrder, "transcodingUser[".concat(t, "].zOrder"), 0, 100), !(tt(e.alpha) || function(e) {
                                    return "number" == typeof e
                                }(e.alpha) && e.alpha <= 1 && e.alpha >= 0)) throw new Error("transcodingUser[${index}].alpha: The value range is [0, 1]")
                        })
                    }
                    Z()(Mt, e), t.gatewayClient.setLiveTranscoding(Mt)
                }, t.addInjectStreamUrl = function(e, i) {
                    ze(e, "url", 1, 255), Ge(i, "config"), !tt(i && i.width) && Je(i.width, "config.width", 0, 1e4), !tt(i && i.height) && Je(i.height, "config.height", 0, 1e4), !tt(i && i.videoGop) && Je(i.videoGop, "config.videoGop", 1, 1e4), !tt(i && i.videoFramerate) && Je(i.videoFramerate, "config.videoFramerate", 1, 1e4), !tt(i && i.videoBitrate) && Je(i.videoBitrate, "config.videoBitrate", 1, 1e4), !tt(i && i.audioSampleRate) && He(i.audioSampleRate, "config.audioSampleRate", [32e3, 44100, 48e3]), !tt(i && i.audioBitrate) && Je(i.audioBitrate, "config.audioBitrate", 1, 1e4), !tt(i && i.audioChannels) && Je(i.audioChannels, "config.audioChannels", 1, 2), Z()(kt, i), t.gatewayClient.addInjectStreamUrl(e, kt)
                }, t.removeInjectStreamUrl = function(e) {
                    ze(e, "url", 1, 255), t.gatewayClient.removeInjectStreamUrl(e)
                }, t.enableAudioVolumeIndicator = function(e, i) {
                    e = e || 2e3, Je(i = i || 3, "smooth", 1, 100), Je(e, "interval", 50, 1e5), t.audioVolumeIndication = t.audioVolumeIndication || {
                        enabled: !0
                    }, t.audioVolumeIndication.interval = e, t.audioVolumeIndication.smooth = i, t.audioVolumeIndication = {
                        interval: e,
                        smooth: i
                    }, le.info("enableAudioVolumeIndicator interval ".concat(e, " smooth ").concat(i)), t.gatewayClient.enableAudioVolumeIndicator(e, i)
                }, t.getNetworkStats = function(e, t) {
                    return le.deprecate("client.getNetworkStats is deprecated. Use client.getTransportStats instead."), Nt.getStats(e, t)
                }, t.getSystemStats = function(e, t) {
                    return Ot.getStats(e, t)
                }, t.getRecordingDevices = function(e, t) {
                    return je.getRecordingDevices(e, t)
                }, t.getPlayoutDevices = function(e, t) {
                    return je.getPlayoutDevices(e, t)
                }, t.getCameras = function(e, t) {
                    return je.getCameras(e, t)
                }, t.getRemoteAudioStats = function(e, i) {
                    return t.rtcStatsCollector.getRemoteAudioStats(e, i)
                }, t.getLocalAudioStats = function(e, i) {
                    return t.rtcStatsCollector.getLocalAudioStats(e, i)
                }, t.getRemoteVideoStats = function(e, i) {
                    return t.rtcStatsCollector.getRemoteVideoStats(e, i)
                }, t.getLocalVideoStats = function(e, i) {
                    return t.rtcStatsCollector.getLocalVideoStats(e, i)
                }, t._getRemoteVideoQualityStats = function(e, i) {
                    return t.rtcStatsCollector.getRemoteVideoQualityStats(e, i)
                }, t._getRemoteAudioQualityStats = function(e, i) {
                    return t.rtcStatsCollector.getRemoteAudioQualityStats(e, i)
                }, t.getTransportStats = function(e, i) {
                    return t.rtcStatsCollector.getTransportStats(function(t) {
                        return Nt.getStats(function(i) {
                            var n = Z()({}, t, i);
                            e && e(n)
                        }, i)
                    }, i)
                }, t.getSessionStats = function(e, i) {
                    return t.rtcStatsCollector.getSessionStats(e, i)
                }, t.onNetworkQuality = function() {
                    return t.rtcStatsCollector.onNetworkQuality(onSuccess, onFailure)
                }, t.gatewayClient = bt(e), t.rtcStatsCollector = function(e) {
                    var t = pe();
                    return t.gatewayClient = e, t.exceptionMonitor = new Ct(e), t.localStats = {}, t.remoteStats = {}, t.session = {
                        sendBytes: 0,
                        recvBytes: 0,
                        WSSendBytes: 0,
                        WSSendBytesDelta: 0,
                        WSRecvBytes: 0,
                        WSRecvBytesDelta: 0,
                        HTTPSendBytes: 0,
                        HTTPSendBytesDelta: 0,
                        HTTPRecvBytes: 0,
                        HTTPRecvBytesDelta: 0
                    }, t.getRemoteAudioStats = function(e) {
                        var i = {};
                        for (var n in t.remoteStats) {
                            var o = {},
                                r = t.remoteStats[n];
                            We(o, "End2EndDelay", r.peer_delay && r.peer_delay.audio_delay), We(o, "TransportDelay", r.peer_delay && r.peer_delay.e2e_delay), We(o, "PacketLossRate", r.peer_delay && r.peer_delay.e2e_audio_lost_ratio_400ms), We(o, "RecvLevel", r.audioStats && r.audioStats.audioOutputLevel), We(o, "RecvBitrate", r.audioRecvBitrate), We(o, "CodecType", r.audioStats && r.audioStats.googCodecName), We(o, "MuteState", r.audioDisabled), We(o, "TotalFreezeTime", r.audioStats && r.audioStats.audioTotalFreezeTime), We(o, "TotalPlayDuration", r.audioStats && r.audioStats.audioTotalPlayDuration), i[n] = o
                        }
                        e && e(i)
                    }, t.getLocalAudioStats = function(e) {
                        var i = {};
                        for (var n in t.localStats) {
                            var o = {},
                                r = t.localStats[n];
                            We(o, "RecordingLevel", r.audioStats && r.audioStats.audioInputLevel), We(o, "SendLevel", r.audioStats && r.audioStats.totalAudioEnergy), We(o, "SamplingRate", r.audioStats && r.audioStats.totalSamplesDuration), We(o, "SendBitrate", r.audioSendBitrate), We(o, "CodecType", r.audioStats && r.audioStats.googCodecName), We(o, "MuteState", r.audioDisabled);
                            var a = t.gatewayClient.localStreams[n];
                            a && a.isPlaying() && We(o, "MuteState", a.audioEnabled ? "0" : "1"), i[n] = o
                        }
                        e && e(i)
                    }, t.getRemoteVideoStats = function(e) {
                        var i = {};
                        for (var n in t.remoteStats) {
                            var o = {},
                                r = t.remoteStats[n];
                            We(o, "End2EndDelay", r.peer_delay && r.peer_delay.video_delay), We(o, "TransportDelay", r.peer_delay && r.peer_delay.e2e_delay), We(o, "PacketLossRate", r.peer_delay && r.peer_delay.e2e_video_lost_ratio_400ms), We(o, "RecvBitrate", r.videoRecvBitrate), We(o, "RecvResolutionWidth", r.videoStats && r.videoStats.googFrameWidthReceived), We(o, "RecvResolutionHeight", r.videoStats && r.videoStats.googFrameHeightReceived), We(o, "RenderResolutionWidth", r.videoStats && r.videoStats.renderRemoteWidth), We(o, "RenderResolutionHeight", r.videoStats && r.videoStats.renderRemoteHeight), We(o, "RenderFrameRate", r.videoStats && r.videoStats.googFrameRateOutput), We(o, "MuteState", r.videoDisabled), We(o, "TotalFreezeTime", r.videoStats && r.videoStats.videoTotalFreezeTime), We(o, "TotalPlayDuration", r.videoStats && r.videoStats.videoTotalPlayDuration), i[n] = o
                        }
                        e && e(i)
                    }, t.getLocalVideoStats = function(e) {
                        var i = {};
                        for (var n in t.localStats) {
                            var o = {},
                                r = t.localStats[n];
                            We(o, "TargetSendBitrate", r.videoTargetSendBitrate), We(o, "SendFrameRate", r.videoStats && r.videoStats.googFrameRateSent), We(o, "SendBitrate", r.videoSendBitrate), We(o, "SendResolutionWidth", r.videoStats && r.videoStats.googFrameWidthSent), We(o, "SendResolutionHeight", r.videoStats && r.videoStats.googFrameHeightSent), We(o, "CaptureResolutionWidth", r.videoStats && r.videoStats.renderLocalWidth), We(o, "CaptureResolutionHeight", r.videoStats && r.videoStats.renderLocalHeight), We(o, "EncodeDelay", r.videoStats && r.videoStats.googAvgEncodeMs), We(o, "MuteState", r.videoDisabled), We(o, "TotalFreezeTime", r.videoStats && r.videoStats.videoTotalFreezeTime), We(o, "TotalDuration", r.videoStats && r.videoStats.videoTotalPlayDuration), We(o, "CaptureFrameRate", r.videoStats && r.videoStats.googFrameRateSent), i[n] = o, e && e(i)
                        }
                    }, t.getRemoteVideoQualityStats = function(e) {
                        var i = {};
                        for (var n in t.remoteStats) {
                            var o = {},
                                r = t.remoteStats[n];
                            We(o, "videoReceiveDelay", r.videoStats && r.videoStats.googCurrentDelayMs), We(o, "VideoFreezeRate", r.videoStats && r.videoStats.videoFreezeRate), We(o, "FirstFrameTime", r.firstFrameTime), i[n] = o
                        }
                        e && e(i)
                    }, t.getRemoteAudioQualityStats = function(e) {
                        var i = {};
                        for (var n in t.remoteStats) {
                            var o = {},
                                r = t.remoteStats[n];
                            We(o, "audioReceiveDelay", r.audioStats && r.audioStats.googCurrentDelayMs), We(o, "AudioFreezeRate", r.videoStats && r.videoStats.videoFreezeRate), i[n] = o
                        }
                        e && e(i)
                    }, t.getTransportStats = function(e) {
                        var i = {},
                            n = {},
                            o = t.gatewayClient.traffic_stats,
                            r = o.peer_delay;
                        if (We(i, "OutgoingAvailableBandwidth", t.gatewayClient.OutgoingAvailableBandwidth / 1e3), We(i, "RTT", o && o.access_delay), r) {
                            var a = !0,
                                s = !1,
                                d = void 0;
                            try {
                                for (var c, u = r[Symbol.iterator](); !(a = (c = u.next()).done); a = !0) {
                                    var l = c.value;
                                    l.downlink_estimate_bandwidth && (n[l.peer_uid] = l.downlink_estimate_bandwidth / 1e3 + "")
                                }
                            } catch (e) {
                                s = !0, d = e
                            } finally {
                                try {
                                    a || null == u.return || u.return()
                                } finally {
                                    if (s) throw d
                                }
                            }
                        }
                        i.IncomingAvailableBandwidth = n, e && e(i)
                    }, t.getSessionStats = function(e) {
                        var i = {},
                            n = t.gatewayClient.traffic_stats,
                            o = t.gatewayClient.socket,
                            r = 0,
                            a = 0;
                        for (var s in t.remoteStats)(d = t.remoteStats[s]) && d.videoStats && d.videoStats.videoRecvBytesDelta && (a += parseInt(d.videoStats.videoRecvBytesDelta)), d && d.audioStats && d.audioStats.audioRecvBytesDelta && (a += parseInt(d.audioStats.audioRecvBytesDelta));
                        for (var s in t.localStats) {
                            var d;
                            (d = t.localStats[s]) && d.videoStats && d.videoStats.videoSendBytesDelta && (r += parseInt(d.videoStats.videoSendBytesDelta)), d && d.audioStats && d.audioStats.audioSendBytesDelta && (r += parseInt(d.audioStats.audioSendBytesDelta))
                        }
                        var c = r + t.session.WSSendBytesDelta + t.session.HTTPSendBytesDelta,
                            u = a + t.session.WSRecvBytesDelta + t.session.HTTPRecvBytesDelta,
                            l = t.session.sendBytes + J(),
                            p = t.session.recvBytes + K();
                        if (t.gatewayClient.socket && t.gatewayClient.socket.state === t.gatewayClient.CONNECTED && (l += o.getSendBytes(), p += o.getRecvBytes()), n.peer_delay) {
                            var g = n.peer_delay.length;
                            g += 1
                        }
                        We(i, "Duration", o.getDuration()), We(i, "UserCount", g), We(i, "SendBytes", l), We(i, "RecvBytes", p), We(i, "SendBitrate", 8 * c / 1e3), We(i, "RecvBitrate", 8 * u / 1e3), e && e(i)
                    }, t.isLocalVideoFreeze = function(e, t) {
                        var i = 0,
                            n = 0;
                        if (!e || !t) return !1;
                        if (u() || g()) i = e.googFrameRateInput, n = e.googFrameRateSent;
                        else if (l()) i = parseInt(e.framerateMean), n = parseInt(e.framesEncoded) - parseInt(t.framesEncoded);
                        else {
                            if (!p()) return !1;
                            i = parseInt(e.framerateMean), n = parseInt(e.framesEncoded) - parseInt(t.framesEncoded)
                        }
                        return i > 5 && n < 3
                    }, t.isRemoteVideoFreeze = function(e, t) {
                        var i = 0,
                            n = 0;
                        if (!e || !t) return !1;
                        if (u() || g()) i = e.googFrameRateReceived, n = e.googFrameRateDecoded;
                        else if (l()) i = e.framerateMean, n = parseInt(e.framesDecoded) - parseInt(t.framesDecoded);
                        else {
                            if (!p()) return !1;
                            i = parseInt(e.framesReceived) - parseInt(t.framesReceived), n = parseInt(e.framesDecoded) - parseInt(t.framesDecoded)
                        }
                        return i > 5 && i < 10 && n < 3 || i > 10 && i < 20 && n < 4 || i > 20 && n < 5
                    }, t.isAudioFreeze = function(e) {
                        if (u() && e) {
                            if (e.googDecodingPLC && e.googDecodingPLCCNG && e.googDecodingCTN) return (parseInt(e.googDecodingPLC) + parseInt(e.googDecodingPLCCNG)) / parseInt(e.googDecodingCTN) > .2
                        } else if ((l() || p()) && e.packetsLost && e.packetsReceived) return parseInt(e.packetsLost) / (parseInt(e.packetsLost) + parseInt(e.packetsReceived)) > .2;
                        return !1
                    }, t.isAudioDecodeFailed = function(e) {
                        return !!((u() || g()) && e && parseInt(e.bytesReceived) > 0 && 0 === parseInt(e.googDecodingNormal))
                    }, t.networkQualityTimer = setInterval(function() {
                        var e = t.gatewayClient.traffic_stats;
                        t.gatewayClient.dispatchEvent({
                            type: "network-quality",
                            uplinkNetworkQuality: t.networkQualityTrans(e.uplink_network_quality),
                            downlinkNetworkQuality: t.networkQualityTrans(e.downlink_network_quality)
                        })
                    }, 2e3), t.networkQualityTrans = function(e) {
                        return e >= 0 && e < .17 ? 1 : e >= .17 && e < .36 ? 2 : e >= .36 && e < .59 ? 3 : e >= .59 && e <= 1 ? 4 : e > 1 ? 5 : 0
                    }, t.getStatsTimer = setInterval(function() {
                        var e = t.gatewayClient.traffic_stats,
                            i = Date.now();
                        t.gatewayClient.dispatchEvent({
                            type: "_testException"
                        }), Object.keys(t.localStats).length && t.exceptionMonitor.setLocalStats(t.localStats), Object.keys(t.remoteStats).length && t.exceptionMonitor.setRemoteStats(t.remoteStats);
                        var n = {};
                        Object.keys(t.gatewayClient.remoteStreams).forEach(function(o) {
                            var r = t.gatewayClient.remoteStreams[o],
                                a = t.remoteStats[o],
                                s = {
                                    id: o,
                                    updatedAt: i
                                };
                            n[o] = s, s.firstFrameTime = r.firstFrameTime, a ? (s.audioTotalPlayDuration = a.audioTotalPlayDuration + 1, s.audioTotalFreezeTime = a.audioTotalFreezeTime, s.isAudioFreeze = !1, s.isAudioDecodeFailed = !1, s.videoTotalPlayDuration = a.videoTotalPlayDuration + 1, s.videoTotalFreezeTime = a.videoTotalFreezeTime, s.isVideoFreeze = !1) : (s.audioTotalPlayDuration = 1, s.audioTotalFreezeTime = 0, s.videoTotalPlayDuration = 1, s.videoTotalFreezeTime = 0);
                            var d = e && e.peer_delay && e.peer_delay.find(function(e) {
                                return e.peer_uid == o
                            });
                            d && (s.peer_delay = d), r && (r.isPlaying() && (s.audioDisabled = r.audioEnabled ? "0" : "1", s.videoDisabled = r.videoEnabled ? "0" : "1"), a && a.peer_delay && d && a.peer_delay.stream_type !== d.stream_type && t.gatewayClient.dispatchEvent({
                                type: "streamTypeChange",
                                uid: o,
                                streamType: d.stream_type
                            }), r.pc && "established" == r.pc.state && r.pc.getStats(function(e) {
                                if (s.pcStats = e, s.audioStats = e.find(function(e) {
                                        return "audio" == e.mediaType && (e.id.indexOf("_recv") > -1 || e.id.toLowerCase().indexOf("inbound") > -1)
                                    }), s.videoStats = e.find(function(e) {
                                        return "video" == e.mediaType && (e.id.indexOf("_recv") > -1 || e.id.toLowerCase().indexOf("inbound") > -1)
                                    }), a && a.audioStats && s.audioStats) {
                                    var i = parseInt(s.audioStats.bytesReceived) - parseInt(a.audioStats.bytesReceived),
                                        n = parseInt(s.audioStats.googDecodingNormal) - parseInt(a.audioStats.googDecodingNormal);
                                    if (s.audioStats.audioRecvBytesDelta = i, s.audioStats.audioDecodingNormalDelta = n, t.session.recvBytes += i, isFinite(i) && s.audioStats.timestamp) {
                                        var o = s.audioStats.timestamp.getTime() - a.audioStats.timestamp.getTime();
                                        s.audioRecvBitrate = Math.floor(8 * i / o)
                                    }
                                    t.isAudioFreeze(s.audioStats) && s.audioTotalPlayDuration > 10 && (s.audioTotalFreezeTime++, s.isAudioFreeze = !0), t.isAudioDecodeFailed(s.audioStats) && s.audioTotalPlayDuration > 10 && (s.isAudioDecodeFailed = !0), s.audioStats.audioTotalFreezeTime = s.audioTotalFreezeTime, s.audioStats.audioTotalPlayDuration = s.audioTotalPlayDuration, s.audioStats.audioFreezeRate = Math.ceil(100 * s.audioTotalFreezeTime / s.audioTotalPlayDuration)
                                }
                                if (a && a.videoStats && s.videoStats) {
                                    var d = parseInt(s.videoStats.bytesReceived) - parseInt(a.videoStats.bytesReceived);
                                    s.videoStats.videoRecvBytesDelta = d, t.session.recvBytes += d, isFinite(d) && s.videoStats.timestamp && (o = s.videoStats.timestamp.getTime() - a.videoStats.timestamp.getTime(), s.videoRecvBitrate = Math.floor(8 * d / o)), t.isRemoteVideoFreeze(s.videoStats, a.videoStats) && (s.videoTotalFreezeTime++, s.isVideoFreeze = !0), s.videoStats.videoTotalFreezeTime = s.videoTotalFreezeTime, s.videoStats.videoTotalPlayDuration = s.videoTotalPlayDuration, s.videoStats.videoFreezeRate = Math.ceil(100 * s.videoTotalFreezeTime / s.videoTotalPlayDuration), s.videoStats.renderRemoteWidth = r.videoWidth || s.videoStats.googFrameWidthReceived, s.videoStats.renderRemoteHeight = r.videoHeight || s.videoStats.googFrameHeightReceived
                                }
                            }))
                        }), t.remoteStats = n;
                        var o = {};
                        if (Object.keys(t.gatewayClient.localStreams).forEach(function(e) {
                                var n = t.gatewayClient.localStreams[e],
                                    r = t.localStats[e],
                                    a = {
                                        id: e,
                                        updatedAt: i
                                    };
                                o[e] = a, r ? (a.videoTotalPlayDuration = r.videoTotalPlayDuration + 1, a.videoTotalFreezeTime = r.videoTotalFreezeTime, a.isVideoFreeze = !1) : (a.videoTotalPlayDuration = 1, a.videoTotalFreezeTime = 0), n && (n.isPlaying() && (a.audioDisabled = n.audioEnabled ? "0" : "1", a.videoDisabled = n.videoEnabled ? "0" : "1"), n.video && n.attributes.maxVideoBW ? a.videoTargetSendBitrate = n.attributes.maxVideoBW : n.video && n.screenAttributes && (a.videoTargetSendBitrate = n.screenAttributes.maxVideoBW), n.pc && "established" == n.pc.state && n.pc.getStats(function(e) {
                                    if (a.pcStats = e.reverse(), a.audioStats = e.find(function(e) {
                                            return "audio" == e.mediaType && (e.id.indexOf("_send") > -1 || e.id.toLowerCase().indexOf("outbound") > -1)
                                        }), a.videoStats = e.find(function(e) {
                                            return "video" == e.mediaType && (e.id.indexOf("_send") > -1 || e.id.toLowerCase().indexOf("outbound") > -1)
                                        }), a.audioStats && r && r.audioStats) {
                                        var i = parseInt(a.audioStats.bytesSent) - parseInt(r.audioStats.bytesSent);
                                        if (a.audioStats.audioSendBytesDelta = i, t.session.sendBytes += i, isFinite(i) && a.audioStats.timestamp) {
                                            var o = a.audioStats.timestamp.getTime() - r.audioStats.timestamp.getTime();
                                            a.audioSendBitrate = Math.floor(8 * i / o)
                                        }
                                    }
                                    if (a.videoStats && r && r.videoStats) {
                                        var s = parseInt(a.videoStats.bytesSent) - parseInt(r.videoStats.bytesSent);
                                        a.videoStats.videoSendBytesDelta = s, t.session.sendBytes += s, isFinite(s) && a.videoStats.timestamp && (o = a.videoStats.timestamp.getTime() - r.videoStats.timestamp.getTime(), a.videoSendBitrate = Math.floor(8 * s / o)), t.isLocalVideoFreeze(a.videoStats, r.videoStats) && (a.videoTotalFreezeTime++, a.isVideoFreeze = !0), a.videoStats.videoTotalFreezeTime = a.videoTotalFreezeTime, a.videoStats.videoTotalPlayDuration = a.videoTotalPlayDuration, a.videoStats.videoFreezeRate = Math.ceil(100 * a.videoTotalFreezeTime / a.videoTotalPlayDuration), a.videoStats.renderLocalWidth = n.videoWidth || a.videoStats.googFrameWidthSent, a.videoStats.renderLocalHeight = n.videoHeight || a.videoStats.googFrameHeightSent
                                    }
                                }))
                            }), t.localStats = o, t.session.HTTPSendBytesDelta = J() - t.session.HTTPSendBytes, t.session.HTTPSendBytes = J(), t.session.HTTPRecvBytesDelta = K() - t.session.HTTPRecvBytes, t.session.HTTPRecvBytes = K(), t.gatewayClient.socket && t.gatewayClient.socket.state === t.gatewayClient.CONNECTED) {
                            var r = t.gatewayClient.socket;
                            t.session.WSSendBytesDelta = r.getSendBytes() - t.session.WSSendBytes, t.session.WSSendBytes = r.getSendBytes(), t.session.WSRecvBytesDelta = r.getRecvBytes() - t.session.WSRecvBytes, t.session.WSRecvBytes = r.getRecvBytes()
                        }
                    }, 1e3), t.gatewayClient.on("join", function() {
                        t.session = {
                            sendBytes: 0,
                            recvBytes: 0,
                            WSSendBytes: 0,
                            WSSendBytesDelta: 0,
                            WSRecvBytes: 0,
                            WSRecvBytesDelta: 0,
                            HTTPSendBytes: 0,
                            HTTPSendBytesDelta: 0,
                            HTTPRecvBytes: 0,
                            HTTPRecvBytesDelta: 0
                        }
                    }), t
                }(t.gatewayClient), t.on = t.gatewayClient.on, tt(e.turnServer) || t.setTurnServer(e.turnServer), tt(e.proxyServer) || t.setProxyServer(e.proxyServer), "live" === t.mode && (t.gatewayClient.role = "audience"), "rtc" === t.mode && (t.gatewayClient.role = "host"), t.on("onMultiIP", function(e) {
                    t.gatewayClient.closeGateway(), t.gatewayClient.socket = void 0, t.gatewayClient.hasChangeBGPAddress = !0, t.joinInfo.multiIP = e.arg.option, t.gatewayClient.state = bt.CONNECTING, mt(t.joinInfo, function(e) {
                        le.info("Joining channel: " + t.channel), t.joinInfo.cid = e.cid, t.joinInfo.uid = e.uid, t.joinInfo.uni_lbs_ip = e.uni_lbs_ip, t.joinInfo.gatewayAddr = e.gateway_addr, t.onSuccess ? t.gatewayClient.join(t.joinInfo, t.key, function(e) {
                            le.info("Join channel " + t.channel + " success");
                            var i = t.onSuccess;
                            t.onSuccess = null, t.onFailure = null, i(e)
                        }, t.onFailure) : (t.gatewayClient.joinInfo = Z()({}, t.joinInfo), t.gatewayClient.rejoin())
                    }, t.onFailure)
                }), t.on("rejoin", function() {
                    var e = 2 === t.highStreamState ? 2 : 0;
                    t.highStream && 0 === e && (le.info("publish after rejoin"), t.highStreamState = 2, t.lowStreamState = 2, t.publish(t.highStream, function(e) {
                        e && le.info(e)
                    }))
                }), t.on("streamPublished", function(e) {
                    t.hasPublished || (t.hasPublished = !0, t.gatewayClient.dispatchEvent(me({
                        type: "stream-published",
                        stream: e.stream
                    })))
                }), t.on("pubP2PLost", function(e) {
                    le.debug("Start reconnect local peerConnection :", t.highStream.getId()), t.gatewayClient.dispatchEvent({
                        type: "stream-reconnect-start",
                        uid: t.highStream.getId()
                    }), 1 === t.highStreamState && (t.highStreamState = 0, t.lowStreamState = 0), t._unpublish(t.highStream, function() {
                        t._publish(t.highStream, function() {
                            le.debug("Reconnect local peerConnection success:", t.highStream.getId()), t.gatewayClient.dispatchEvent({
                                type: "stream-reconnect-end",
                                uid: t.highStream.getId(),
                                success: !0,
                                reason: ""
                            })
                        }, function(e) {
                            le.debug("Reconnect local peerConnection failed:" + e), t.gatewayClient.dispatchEvent({
                                type: "stream-reconnect-end",
                                uid: t.highStream.getId(),
                                success: !1,
                                reason: e
                            })
                        })
                    }, function(e) {
                        le.debug("Reconnect local peerConnection failed:" + e), t.gatewayClient.dispatchEvent({
                            type: "stream-reconnect-end",
                            uid: t.highStream.getId(),
                            success: !1,
                            reason: e
                        })
                    })
                }), t.on("subP2PLost", function(e) {
                    le.debug("Start reconnect remote peerConnection :", e.stream.getId()), t.gatewayClient.dispatchEvent({
                        type: "stream-reconnect-start",
                        uid: e.stream.getId()
                    }), t.gatewayClient.unsubscribe(e.stream, function() {
                        t.gatewayClient.subscribe(e.stream, function() {
                            le.debug("Reconnect remote peerConnection success:", e.stream.getId()), t.gatewayClient.dispatchEvent({
                                type: "stream-reconnect-end",
                                uid: e.stream.getId(),
                                success: !1,
                                reason: ""
                            })
                        }, function(i) {
                            le.debug("Reconnect remote peerConnection failed:" + i), t.gatewayClient.dispatchEvent({
                                type: "stream-reconnect-end",
                                uid: e.stream.getId(),
                                success: !1,
                                reason: i
                            })
                        })
                    }, function(i) {
                        le.debug("Reconnect remote peerConnection failed:" + i), t.gatewayClient.dispatchEvent({
                            type: "stream-reconnect-end",
                            uid: e.stream.getId(),
                            success: !1,
                            reason: i
                        })
                    })
                }), Nt.on("networkTypeChanged", function(e) {
                    t.gatewayClient && t.gatewayClient.dispatchEvent(e);
                    var i = Z()({}, e, {
                        type: "network-type-changed"
                    });
                    t.gatewayClient.dispatchEvent(i)
                }), je.on("recordingDeviceChanged", function(e) {
                    t.gatewayClient && t.gatewayClient.dispatchEvent(e);
                    var i = Z()({}, e, {
                        type: "recording-device-changed"
                    });
                    t.gatewayClient.dispatchEvent(i)
                }), je.on("playoutDeviceChanged", function(e) {
                    t.gatewayClient && t.gatewayClient.dispatchEvent(e);
                    var i = Z()({}, e, {
                        type: "playout-device-changed"
                    });
                    t.gatewayClient.dispatchEvent(i)
                }), je.on("cameraChanged", function(e) {
                    t.gatewayClient && t.gatewayClient.dispatchEvent(e);
                    var i = Z()({}, e, {
                        type: "camera-changed"
                    });
                    t.gatewayClient.dispatchEvent(i)
                }), t.gatewayClient.on("streamTypeChange", function(e) {
                    var i = Z()({}, e, {
                        type: "stream-type-changed"
                    });
                    t.gatewayClient.dispatchEvent(i), ne.reportApiInvoke(t.joinInfo.sid, {
                        name: "streamTypeChange"
                    })(null, JSON.stringify(e))
                }), t
            },
            Mt = {
                width: 640,
                height: 360,
                videoBitrate: 400,
                videoFramerate: 15,
                lowLatency: !1,
                audioSampleRate: 48e3,
                audioBitrate: 48,
                audioChannels: 1,
                videoGop: 30,
                videoCodecProfile: 100,
                userCount: 0,
                userConfigExtraInfo: {},
                backgroundColor: 0,
                transcodingUsers: []
            },
            kt = {
                width: 0,
                height: 0,
                videoGop: 30,
                videoFramerate: 15,
                videoBitrate: 400,
                audioSampleRate: 44100,
                audioBitrate: 48,
                audioChannels: 1
            },
            Lt = je.getDevices,
            xt = xe;
        t.default = {
            TranscodingUser: {
                uid: 0,
                x: 0,
                y: 0,
                width: 0,
                height: 0,
                zOrder: 0,
                alpha: 1
            },
            LiveTranscoding: Mt,
            createClient: function(e) {
                (e = Z()({}, e || {})).codec || (e.codec = function(e) {
                    switch (e) {
                        case "h264_interop":
                            return "h264";
                        default:
                            return "vp8"
                    }
                }(e.mode));
                var t = function(e) {
                    return nt.includes(e.mode) ? ot.includes(e.codec) ? "h264_interop" == e.mode && "h264" !== e.codec && be.CLIENT_MODE_CODEC_MISMATCH : be.INVALID_CLIENT_CODEC : be.INVALID_CLIENT_MODE
                }(e);
                if (t) throw le.error("Invalid parameter setting MODE : " + e.mode + " CODEC : " + e.codec + " ERROR " + t), new Error(t);
                return le.info("Creating client , MODE : " + e.mode + " CODEC : " + e.codec),
                    function(e) {
                        switch (e.mode) {
                            case "interop":
                            case "h264_interop":
                                e.mode = "live";
                                break;
                            case "web-only":
                                e.mode = "rtc"
                        }
                    }(e), Dt(e)
            },
            createStream: function(e) {
                Ge(e, "StreamSpec");
                var t = e.streamID,
                    i = e.audio,
                    n = e.video,
                    o = e.screen,
                    r = (e.audioSource, e.videoSource, e.cameraId),
                    a = e.microphoneId,
                    s = e.mirror,
                    d = e.extensionId,
                    c = e.mediaSource,
                    u = e.audioProcessing;
                if (!tt(t) && !W(t) && !Ye(t, 1, 255)) throw new Error("[String streamID] Length of the string: [1,255]. ASCII characters only. [Number streamID] The value range is [0,10000]");
                if (Ke(i, "audio"), Ke(n, "video"), tt(o) || Ke(o, "screen"), tt(r) || ze(r, "cameraId"), tt(a) || ze(a, "microphoneId"), tt(d) || ze(d, "extensionId"), tt(c) || He(c, "mediaSource", ["screen", "application", "window"]), tt(s) || Ke(s, "mirror"), !tt(u)) {
                    var l = u.AGC,
                        p = u.AEC,
                        g = u.ANS;
                    tt(l) || Ke(l, "AGC"), tt(p) || Ke(p, "AEC"), tt(g) || Ke(g, "ANS")
                }
                return le.debug("Create stream"), it(e)
            },
            Logger: le,
            getDevices: Lt,
            getScreenSources: xt,
            checkSystemRequirements: function() {
                var e = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection,
                    t = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.msGetUserMedia || navigator.mozGetUserMedia || navigator.mediaDevices && navigator.mediaDevices.getUserMedia,
                    i = window.WebSocket,
                    n = !!e && !!t && !!i,
                    o = !1;
                return le.debug(S(), "isAPISupport:" + n), u() && f() >= 58 && "iOS" !== v() && (o = !0), p() && f() >= 56 && (o = !0), g() && f() >= 45 && (o = !0), l() && f() >= 11 && (o = !0), (m() || function() {
                        var e = S();
                        return e.name && "QQBrowser" === e.name
                    }()) && "iOS" !== v() && (o = !0),
                    function() {
                        var e = v();
                        return "Linux" === e || "Mac OS X" === e || "Mac OS" === e || -1 !== e.indexOf("Windows")
                    }() || function() {
                        var e = v();
                        return "Android" === e || "iOS" === e
                    }() || (o = !1), n && o
            },
            VERSION: "2.5.1",
            BUILD: n,
            AUDIO_SAMPLE_RATE_32000: 32e3,
            AUDIO_SAMPLE_RATE_44100: 44100,
            AUDIO_SAMPLE_RATE_48000: 48e3,
            VIDEO_CODEC_PROFILE_BASELINE: 66,
            VIDEO_CODEC_PROFILE_MAIN: 77,
            VIDEO_CODEC_PROFILE_HIGH: 100,
            REMOTE_VIDEO_STREAM_HIGH: 0,
            REMOTE_VIDEO_STREAM_LOW: 1,
            REMOTE_VIDEO_STREAM_MEDIUM: 2
        }
    }]).default
});