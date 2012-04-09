
### SVG Gradient Generator

When building a “responsive” web site, it’s useful to keep everything on the
page scalable by using vector images wherever possible. Buttons are one of the
elements that often create a challange, with all of their glossy roundness and
gradients galore.

This project is intended to make the process of creating plain HTML buttons
(styled with CSS) really easy by giving you the gradient as an SVG image that
will work in all modern browsers (while still looking decent in the older
ones, since a solid fall-back color is provided).

SVG gradients are useful for lots of other things too, like backgrounds within
a module or even the whole page. That’s the beauty of a vector image; it’s
once-size-fits-all.

If you simply want to use the tool, it’s currently hosted here:
http://jimbomatic.com/gradient/

### Data URI

To save an HTTP request (which is good for keeping the page-load time short)
and to spare you the trouble of hosting an image file, the generator also
encodes the SVG image as a Data URI. (This should also work in all of the
browsers that support SVG.)
