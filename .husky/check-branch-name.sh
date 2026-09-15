#!/bin/sh
# Enforces the branch naming convention:  feature/<ticketnumber>-<description>
# Examples:  feature/02-hello-world   feature/11-oop-inheritance

PATTERN='^feature/[0-9]{1,4}-[a-z0-9]+(-[a-z0-9]+)*$'

# During a rebase/merge HEAD is detached - there is no branch to validate.
BRANCH="$(git symbolic-ref --quiet --short HEAD 2>/dev/null)"
if [ -z "$BRANCH" ]; then
  echo "ℹ️  Detached HEAD (rebase/merge in progress) - skipping branch name check."
  exit 0
fi

suggest() {
  echo ""
  echo "   Branch names must look like:  feature/<ticketnumber>-<description>"
  echo ""
  echo "     ✅  feature/02-hello-world"
  echo "     ✅  feature/07-functions"
  echo "     ✅  feature/11-oop-inheritance"
  echo ""
  echo "     ❌  hello-world          (no feature/ prefix, no ticket number)"
  echo "     ❌  feature/hello        (missing ticket number)"
  echo "     ❌  feature/02_Hello     (use lowercase and dashes, not _ or capitals)"
  echo ""
  echo "   Rename the branch you are on right now with:"
  echo ""
  echo "     git branch -m feature/<ticketnumber>-<description>"
  echo ""
  echo "   Ticket numbers come from the files in tickets/ (e.g. tickets/02-hello-world.md → feature/02-hello-world)."
  echo ""
}

if [ "$BRANCH" = "master" ] || [ "$BRANCH" = "main" ]; then
  echo ""
  echo "🚫  Commit rejected: you are committing straight to '$BRANCH'."
  echo ""
  echo "   Every ticket gets its own branch. Move your work onto one:"
  echo ""
  echo "     git switch -c feature/<ticketnumber>-<description>"
  echo ""
  echo "   (Your staged changes come with you - nothing is lost.)"
  echo ""
  exit 1
fi

if ! echo "$BRANCH" | grep -Eq "$PATTERN"; then
  echo ""
  echo "🚫  Commit rejected: branch name '$BRANCH' does not follow the convention."
  suggest
  exit 1
fi

echo "✅  Branch name '$BRANCH' is valid."
exit 0
