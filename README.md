# Livezip

Livezip is a tool used to zip a directories on the fly. Its implemented in pure php
and thus can be used with any web server. Also included is a docker-compose file to get going
with a simple "docker-compose up"

## Usage

Deploy to any existing php web server or run one with "docker-compose up". If this is placed in the root of
www.domain.com, it will generate on-the-fly zips of any projects in the workspace directory. For example
url www.domain.com/livezip/k8s-asterisk will serve a live zip file of local files <webroot>/workspace/k8s-asterisk