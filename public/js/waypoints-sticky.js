(() => {
    'use strict';

    class WaypointSticky {
      constructor(options) {
        this.options = Object.assign({}, WaypointSticky.defaults, options);
        this.element = this.options.element;
        this.$element = document.querySelector(this.element);

        this.createWrapper();
        this.createWaypoint();
      }

      createWaypoint() {
        const { handler, direction } = this.options;

        this.waypoint = new Waypoint({
          element: this.wrapper,
          handler: (direction) => {
            const isSticky = direction.indexOf(direction) > -1;
            const height = isSticky ? this.$element.offsetHeight : '';

            this.$wrapper.style.height = height + 'px';
            this.$element.classList.toggle(this.options.stuckClass, isSticky);

            handler && handler.call(this, direction);
          },
        });
      }

      createWrapper() {
        if (this.options.wrapper) {
          const wrapperElement = document.createElement('div');
          wrapperElement.className = 'sticky-wrapper';

          this.$element.parentNode.insertBefore(wrapperElement, this.$element);
          wrapperElement.appendChild(this.$element);

          this.$wrapper = wrapperElement;
        }
      }

      destroy() {
        if (this.$element.parentNode === this.$wrapper) {
          this.waypoint.destroy();
          this.$element.classList.remove(this.options.stuckClass);

          if (this.options.wrapper) {
            this.$wrapper.parentNode.insertBefore(this.$element, this.$wrapper);
            this.$wrapper.remove();
          }
        }
      }
    }

    WaypointSticky.defaults = {
      wrapper: '<div class="sticky-wrapper" />',
      stuckClass: 'is-fixed',
      direction: 'down right',
    };

    window.Waypoint.Sticky = WaypointSticky;
  })();
