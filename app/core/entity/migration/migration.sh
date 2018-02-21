#!/usr/bin/env bash

vendor/bin/phinx create RouteMigration -c config-phinx.php
vendor/bin/phinx create ProductMigration -c config-phinx.php
vendor/bin/phinx create ProductImageMigration -c config-phinx.php
vendor/bin/phinx create ShopMigration -c config-phinx.php
vendor/bin/phinx create CategoryMigration -c config-phinx.php
vendor/bin/phinx create StateMigration -c config-phinx.php
vendor/bin/phinx create SectionMigration -c config-phinx.php
vendor/bin/phinx create SectionImageMigration -c config-phinx.php
vendor/bin/phinx create UserMigration -c config-phinx.php
vendor/bin/phinx create RoleMigration -c config-phinx.php
vendor/bin/phinx create RoleUserMigration -c config-phinx.php
vendor/bin/phinx create UserShopProductCategoryMigration -c config-phinx.php