# Habit Grid

<!-- https://github.com/austenc/habitgrid -->

A habit tracker inspired by github's contributions graph.

This is a work in progress, we are building it on stream:

🎥 [Tune in on Twitch](https://twitch.tv/austencam)

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

## Today

-   [x] Adjust streak query to only look for days prior to today
-   [x] Add streak to livewire component? Nested components? 🤔
-   [x] At mobile size, put toggle buttons in a popup, also make dots bigger?
-   [x] Make stat tiles dynamic / decide what to do with them

## Planned features

-   [ ] Finish hooking up tracking data to week tiles
-   [ ] Improve all the requests happening when days selected
-   [ ] Build navbar
-   [ ] Combine dashboard and habits index
    -   [ ] Make create form toggleable
-   [ ] Integrate user scoping and authentication
-   [ ] Add support for tracking specific units when completing
-   [ ] Add notes a given track
-   [ ] Add loading states to buttons?

## Future stream ideas (what are yours?)

-   [ ] Habit leaderboards
-   [ ] Group habit tracking (like a team goal tracker)
-   [ ] Public habit pages / toggle visibility
-   [ ] Challenge friends to a habit battle
-   [ ] Building a form component system
-   [ ] Flash messages / notifications components with Alpine JS
