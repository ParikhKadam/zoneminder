<?php
//
// ZoneMinder web action file
// Copyright (C) 2019 ZoneMinder LLC
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
//

if ( !canEdit('System') ) {
  Warning("Need System permissions to update privacy");
  return;
}

if ( ($action == 'privacy') && isset($_REQUEST['option']) ) {
  switch( $_REQUEST['option'] ) {
  case 'decline' :
    dbQuery("UPDATE Config SET Value = '0' WHERE Name = 'ZM_SHOW_PRIVACY'");
    dbQuery("UPDATE Config SET Value = '0' WHERE Name = 'ZM_TELEMETRY_DATA'");
    $redirect = ZM_BASE_URL.$_SERVER['PHP_SELF'].'?view=console';
    break;
  case 'accept' :
    dbQuery("UPDATE Config SET Value = '0' WHERE Name = 'ZM_SHOW_PRIVACY'");
    dbQuery("UPDATE Config SET Value = '1' WHERE Name = 'ZM_TELEMETRY_DATA'");
    $redirect = ZM_BASE_URL.$_SERVER['PHP_SELF'].'?view=console';
    break;
  default: # Enable the privacy statement if we somehow submit something other than accept or decline
    dbQuery("UPDATE Config SET Value = '1' WHERE Name = 'ZM_SHOW_PRIVACY'");
  } // end switch option
?>
