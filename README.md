# TYPO3 legacy `cli_dispatch.phpsh` entry point [![Build Status](https://travis-ci.org/pagemachine/typo3-composer-legacy-cli.svg)](https://travis-ci.org/pagemachine/typo3-composer-legacy-cli) [![Latest Stable Version](https://poser.pugx.org/pagemachine/typo3-composer-legacy-cli/v/stable)](https://packagist.org/packages/pagemachine/typo3-composer-legacy-cli) [![Total Downloads](https://poser.pugx.org/pagemachine/typo3-composer-legacy-cli/downloads)](https://packagist.org/packages/pagemachine/typo3-composer-legacy-cli) [![Latest Unstable Version](https://poser.pugx.org/pagemachine/typo3-composer-legacy-cli/v/unstable)](https://packagist.org/packages/pagemachine/typo3-composer-legacy-cli) [![License](https://poser.pugx.org/pagemachine/typo3-composer-legacy-cli/license)](https://packagist.org/packages/pagemachine/typo3-composer-legacy-cli)

This package provides an entry point for the deprecated `cli_dispatch.phpsh` script.

This script is missing if single `typo3/cms-*` packages are installed instead of `typo3/cms`. Similar to [`helhum/typo3-composer-setup`](https://github.com/helhum/typo3-composer-setup) this entry point is generated on the fly without symlinks.

## Installation

    composer require pagemachine/typo3-composer-legacy-cli
