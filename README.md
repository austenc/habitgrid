# Habit Grid

<!-- https://github.com/austenc/habitgrid -->

A habit tracker inspired by github's contributions graph.

This is a work in progress, we are building it on stream:

🎥 [Tune in on Twitch](https://twitch.tv/austencam)

## Today

-   [x] Upgrade TailwindCSS to 1.7 🚀
-   [x] Fix modal margin bug at mobile size
-   [x] Fix "tracked in past week" to get total habits, not tracks
-   [ ] Fix tooltip alignment
    -   [ ] Add additional info about which habits are tracked
-   [ ] Integrate user scoping and authentication
-   [ ] Notifications / toast messages
-   [ ] Add support for tracking specific units when completing
-   [ ] Add notes a given track

## Future Streams (suggestions chat?)

-   [ ] Flash messages / notifications components with Alpine JS
-   [ ] Habit leaderboards
-   [ ] Group habit tracking (like a team goal tracker)
-   [ ] Building a form component system
-   [ ] Public habit pages / toggle visibility
-   [ ] Challenge friends to a habit battle

## Done

-   [x] Build habit create form
-   [x] Build tooltip when hovering over a given day on the grid
-   [x] Fix bug in grid display to sort by start of week (`startOfWeek()` in carbon?)
-   [x] Add a way to track a habit for a certain day
-   [x] Show grid filled in for days with a habit tracked
-   [x] Differentiate colors based on how many habits were done
-   [x] Build the "legend"
-   [x] Fix responsiveness of day grid
-   [x] Write some tests for day grid component
-   [x] Navigate between days easily (prev/next buttons)
-   [x] Habit edit form
-   [x] Optionally scope day grid to a single habit for details page
-   [x] Make "stream" badge dynamic (or try)
-   [x] Improve current streak relation so we don't need first
-   [x] Fix current streak query (date calculation is off)
-   [x] Adjust streak query to only look for days prior to today
-   [x] Add streak to livewire component? Nested components? 🤔
-   [x] At mobile size, put toggle buttons in a popup, also make dots bigger?
-   [x] Make stat tiles dynamic / decide what to do with them
-   [x] Refactor how the day grid handles the habit ID
-   [x] Refactor how the selected / week days work within `week-view`
-   [x] Add loading state when changing days
-   [x] Finish hooking up tracking data to week tiles
-   [x] Combine dashboard and habits index and make create form toggleable
-   [x] Build navbar + responsive version
-   [x] Make proper dashboard page with stat tiles
