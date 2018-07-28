---
id: publishing
title: Publishing your site
---

You should now have a [site up and running locally](getting-started-site-creation.md). Once you have [customized](api-site-config.md) it to your liking, it's time to publish it. Docusaurus generates a static HTML website that is ready to be served by your favorite web server or online hosting solution.

## Building Static HTML Pages

To create a static build of your website, run the following script from the `website` directory:

```bash
yarn run build # or `npm run build`
```

This will generate a `build` directory inside the `website` directory containing the `.html` files from all of your docs and other pages included in `pages`.

## Hosting Static HTML Pages

At this point, you can grab all of the files inside the `website/build` directory and copy them over to your favorite web server's `html` directory.

> For example, both Apache and nginx serve content from `/var/www/html` by default. That said, choosing a web server or provider is outside the scope of Docusaurus.

> When serving the site from your own web server, ensure the web server is serving the asset files with the proper HTTP headers. CSS files should be served with the `content-type` header of `text/css`. In the case of nginx, this would mean setting `include /etc/nginx/mime.types;` in your `nginx.conf` file. See [this issue](https://github.com/facebook/Docusaurus/issues/602) for more info.

### Hosting on a Service:

* [GitHub Pages](#using-github-pages)
* [Netlify](#hosting-on-netlify)

### Using GitHub Pages

While choosing a web server or host is outside Docusaurus' scope, Docusaurus was designed to work really well with one of the most popular hosting solutions for open source projects: [GitHub Pages](https://pages.github.com/).

Deploying your Docusaurus site to GitHub Pages is straightforward if you are already using GitHub to host your project. Your code repository does not even need to be public.

> Even if your repository is private, anything published to a `gh-pages` branch will be [public](https://help.github.com/articles/user-organization-and-project-pages/).

Most of the work to publish to GitHub pages is done for you automatically through the [`publish-gh-pages`](./api-commands.md#docusaurus-publish) script. You just need to determine the values for a few parameters required by the script.

Two of the required parameters are set in the [`siteConfig.js`](api-site-config.md):

| Name               | Description                                                                                                                                                                              |
| ------------------ | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `organizationName` | The GitHub user or organization that owns the repository. In the case of Docusaurus, that would be the "facebook" GitHub organization.                                                   |
| `projectName`      | The name of the GitHub repository for your project. For example, Docusaurus is hosted at https://github.com/facebook/docusaurus, so our project name in this case would be "docusaurus". |

> Docusaurus also supports deploying [user or organization sites](https://help.github.com/articles/user-organization-and-project-pages/#user--organization-pages). To do this, just set `projectName` to "_username_.github.io" (where _username_ is your username or organization name on GitHub) and `organizationName` to "_username_".  
> For user or org sites, the publish script will deploy these sites to the root of the `master` branch of the _username_.github.io repo. In this case, note that you will want to have the Docusaurus infra, your docs, etc. either in another branch of the _username_.github.io repo (e.g., maybe call it `source`), or in another, separated repo (e.g. in the same as the documented source code).

> While we recommend setting the `projectName` and `organizationName` in `siteConfig.js`, you can also use environment variables `ORGANIZATION_NAME` and `PROJECT_NAME`.

One of the required parameters is set as a environment variable:

| Name       | Description                                                                                                                                      |
| ---------- | ------------------------------------------------------------------------------------------------------------------------------------------------ |
| `GIT_USER` | The username for a GitHub account that has commit access to this repo. For your own repositories, this will usually be your own GitHub username. |

There are also two optional parameters that are set as environment variables:

| Name             | Description                                                                                                                                                                                                                                                       |
| ---------------- | ----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `USE_SSH`        | If this is set to `true`, then SSH is used instead of HTTPS for the connection to the GitHub repo. HTTPS is the default if this variable is not set.                                                                                                              |
| `CURRENT_BRANCH` | The branch that contains the latest docs changes that will be deployed. Usually, the branch will be `master`, but it could be any branch (default or otherwise) except for `gh-pages`. If nothing is set for this variable, then the current branch will be used. |

Once you have the parameter value information, you can go ahead and run the publish script, ensuring you have inserted your own values inside the various parameter placeholders:

To run the script directly from the command-line, you can use the following, filling in the parameter values as appropriate. If you run into issues related to SSH keys, visit [GitHub's authentication documentation](https://help.github.com/articles/connecting-to-github-with-ssh/).

```bash
GIT_USER=<GIT_USER> \
  CURRENT_BRANCH=master \
  USE_SSH=true \
  yarn run publish-gh-pages # or `npm run publish-gh-pages`
```

> The specified `GIT_USER` must have push access to the repository specified in the combination of `organizationName` and `projectName`.

You should now be able to load your website by visiting its GitHub Pages URL, which could be something along the lines of https://_username_.github.io/_projectName_, or a custom domain if you have set that up. For example, Docusaurus' own GitHub Pages URL is https://facebook.github.io/Docusaurus (it can also be accessed via https://docusaurus.io/), because it is served from the `gh-pages` branch of the https://github.com/facebook/docusaurus GitHub repository. We highly encourage reading through the [GitHub Pages documentation](https://pages.github.com) to learn more about how this hosting solution works.

You can run the command above any time you update the docs and wish to deploy the changes to your site. Running the script manually may be fine for sites where the documentation rarely changes and it is not too much of an inconvenience to remember to manually deploy changes.

However, you can automate the publishing process with continuous integration (CI).

## Automating Deployments Using Continuous Integration

Continuous integration (CI) services are typically used to perform routine tasks whenever new commits are checked in to source control. These tasks can be any combination of running unit tests and integration tests, automating builds, publishing packages to NPM, and yes, deploying changes to your website. All you need to do to automate deployment of your website is to invoke the `publish-gh-pages` script whenever your docs get updated. In the following section we'll be covering how to do just that using [Circle CI](https://circleci.com/), a popular continuous integration service provider.

### Using Circle CI 2.0

If you haven't done so already, you can [setup CircleCI](https://circleci.com/signup/) for your open source project. Afterwards, in order to enable automatic deployment of your site and documentation via CircleCI, just configure Circle to run the `publish-gh-pages` script as part of the deployment step. You can follow the steps below to get that setup.

1.  Ensure the GitHub account that will be set as the `GIT_USER` has `write` access to the repository that contains the documentation, by checking `Settings | Collaborators & teams` in the repository.
1.  Log into GitHub as the `GIT_USER`.
1.  Go to https://github.com/settings/tokens for the `GIT_USER` and generate a new [personal access token](https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/), granting it full control of private repositories through the `repository` access scope. Store this token in a safe place, making sure to not share it with anyone. This token can be used to authenticate GitHub actions on your behalf in place of your GitHub password.
1.  Open your Circle CI dashboard, and navigate to the Settings page for your repository, then select "Environment variables". The URL looks like https://circleci.com/gh/ORG/REPO/edit#env-vars, where "ORG/REPO" should be replaced with your own GitHub organization/repository.
1.  Create a new environment variable named `GITHUB_TOKEN`, using your newly generated access token as the value.
1.  Create a `.circleci` directory and create a `config.yml` under that directory.
1.  Copy the text below into `.circleci/config.yml`.

```yaml
# If you only want circle to run on direct commits to master, you can uncomment this out
# and uncomment the filters: *filter-only-master down below too
#
# aliases:
#  - &filter-only-master
#    branches:
#      only:
#        - master

version: 2
jobs:
  deploy-website:
    docker:
      # specify the version you desire here
      - image: circleci/node:8.11.1

    steps:
      - checkout
      - run:
          name: Deploying to GitHub Pages
          command: |
            git config --global user.email "<GITHUB_USERNAME>@users.noreply.github.com"
            git config --global user.name "<YOUR_NAME>"
            echo "machine github.com login <GITHUB_USERNAME> password $GITHUB_TOKEN" > ~/.netrc
            cd website && yarn install && GIT_USER=<GIT_USER> yarn run publish-gh-pages

workflows:
  version: 2
  build_and_deploy:
    jobs:
      - deploy-website:
#         filters: *filter-only-master
```

Make sure to replace all `<....>` in the `command:` sequence with appropriate values. For `<GIT_USER>`, it should be a GitHub account that has access to push documentation to your GitHub repository. Many times `<GIT_USER>` and `<GITHUB_USERNAME>` will be the same.

**DO NOT** place the actual value of `$GITHUB_TOKEN` in `circle.yml`. We already configured that as an environment variable back in Step 3.

> If you want to use SSH for your GitHub repository connection, you can set `USE_SSH=true`. So the above command would look something like: `cd website && npm install && GIT_USER=<GIT_USER> USE_SSH=true npm run publish-gh-pages`.

> Unlike when you run the `publish-gh-pages` script manually, when the script runs within the Circle environment, the value of `CURRENT_BRANCH` is already defined as an [environment variable within CircleCI](https://circleci.com/docs/1.0/environment-variables/) and will be picked up by the script automatically.

Now, whenever a new commit lands in `master`, CircleCI will run your suite of tests and, if everything passes, your website will be deployed via the `publish-gh-pages` script.

> If you would rather use a deploy key instead of a personal access token, you can by starting with the Circle CI [instructions](https://circleci.com/docs/1.0/adding-read-write-deployment-key/) for adding a read/write deploy key.

### Tips & Tricks

When initially deploying to a `gh-pages` branch using Circle CI, you may notice that some jobs triggered by commits to the `gh-pages` branch fail to run successfully due to a lack of tests. You can easily work around this by creating a basic Circle CI config with the following contents:

```yaml
# Circle CI 2.0 Config File
# This config file will prevent tests from being run on the gh-pages branch.
version: 2
jobs:
  build:
    machine: true
    branches:
      ignore: gh-pages
    steps:
      - run: echo "Skipping tests on gh-pages branch"
```

Save this file as `config.yml` and place it in a `.circleci` directory inside your `website/static` directory.

### Using Travis CI

1.  Go to https://github.com/settings/tokens and generate a new [personal access token](https://help.github.com/articles/creating-a-personal-access-token-for-the-command-line/)
1.  Using your GitHub account, [add the Travis CI app](https://github.com/marketplace/travis-ci) to the repository you want to activate.
1.  Open your Travis CI dashboard. The URL looks like https://travis-ci.com/USERNAME/REPO, and navigate to the `More options` > `Setting` > `Environment Variables` section of your repository.
1.  Create a new environment variable named `GH_TOKEN` with your newly generated token as its value, then `GH_EMAIL` (your email address) and `GH_NAME` (your GitHub username).
1.  Create a `.travis.yml` on the root of your repository with below text.

```yaml
# .travis.yml
language: node_js
node_js:
  - '8'
branches:
  only:
    - master
cache:
  yarn: true
script:
  - git config --global user.name "${GH_NAME}"
  - git config --global user.email "${GH_EMAIL}"
  - echo "machine github.com login ${GH_NAME} password ${GH_TOKEN}" > ~/.netrc
  - cd website && yarn install && GIT_USER="${GH_NAME}" yarn run publish-gh-pages
```

Now, whenever a new commit lands in `master`, Travis CI will run your suite of tests and, if everything passes, your website will be deployed via the `publish-gh-pages` script.

### Hosting on Netlify

Steps to configure your Docusaurus-powered site on Netlify.

1.  Select **New site from Git**
1.  Connect to your preferred Git provider.
1.  Select the branch to deploy. Default is `master`
1.  Configure your build steps:

    * For your build command enter: `cd website; npm install; npm run build;`
    * For publish directory: `website/build/<projectName>` (use the `projectName` from your `siteConfig`)

1.  Click **Deploy site**

You can also configure Netlify to rebuild on every commit to your repository, or only `master` branch commits.

### Publishing to GitHub Enterprise

GitHub enterprise installations should work in the same manner as github.com; you only need to identify the organization's GitHub Enterprise host.

| Name          | Description                                    |
| ------------- | ---------------------------------------------- |
| `GITHUB_HOST` | The hostname for the GitHub enterprise server. |

Alter your `siteConfig.js` to add a property `'githubHost'` which represents the GitHub Enterprise hostname. Alternatively, set an environment variable `GITHUB_HOST` when executing the publish command.
