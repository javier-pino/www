<div id="main">
    <div id="flash-pad">
        <div id="success-flash" style="display: none">
            
        </div>        
    </div>
    <h2>Listar Usuarios</h2>
    <div class="content-accounts">
        <div class="content-accounts-two">
            <div class="content-accounts-three">
                <div class="worksheet-nav">
                    <ul class="worksheet-views">
                        <li class="views">View:</li>
                        <li><a href="/worksheet" class="month">Month</a></li>
                        <li><a href="/week" class="week">Week</a></li>
                        <li><a href="/list" class="list">List</a></li>
                    </ul>
                    <ul class="worksheet-nav">
                        <li><a href="/entries/new" class="ws-income">Add Income</a></li>
                        <li><a href="/entries/new?type=expense" class="ws-expense">Add Expense</a></li>
                        <li><a href="/export" class="ws-export">Export</a></li>
                    </ul>
                </div>
                <div id="worksheet_data">
                    <script type="text/javascript">
                        /*jQuery(
                        function()
                        {
                            jQuery(".edit-flyout").hover(
                            function()
                            {
                                jQuery(this).addClass("edit-on");
                            },
                            function()
                            {
                                jQuery(this).removeClass("edit-on");
                            }
                        )
                        }*/
                    )
                    </script>
                    <table width="100%" class="cash" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <td id="month-span" width="24%">Aug 12 – Apr 13</td>
                                <td class="arrow" width="1%"><a href="/worksheet/2012/7" title="Previous Month"><img src="/images/icon_month-previous.gif" width="16" height="16" alt="Previous Month"></a></td>

                                <th class="month ">August</th>

                                <th class="month current">September</th>

                                <th class="month ">October</th>

                                <th class="month ">November</th>

                                <th class="month ">December</th>

                                <th class="month ">January</th>

                                <th class="month ">February</th>

                                <th class="month ">March</th>

                                <th class="month ">April</th>

                                <td class="arrow" width="1%"><a href="/worksheet/2012/9" title="Next Month"><img src="/images/icon_month-next.gif" width="16" height="16" alt="Next Month"></a></td>
                            </tr>
                        </thead>

                        <tbody id="cash-on-hand">
                            <tr>
                                <th colspan="2">Cash on hand<br><small>Beginning of the month</small></th>


                                <td>0.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>2,170.00</td>


                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                        <tbody id="income-header">
                            <tr>
                                <th colspan="2"><a href="#" id="income-btn" class="active" onclick="action_toggle('income-btn','income'); toggle_worsheet_cookie(this,'wk', 'income', 'active', '1'); return false;" >Income</a></th>

                                <td>2,400.00</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>
                            </tr>

                        </tbody>       

                        <tbody id="income" >



                            <tr class="category expand" id="category_101361">
                                <th colspan="2"><a href="#" class="expand" onclick="toggle_category(101361, 'income'); toggle_worsheet_cookie(this,'wk', 'income-101361', 'expand', '1'); return false" id="category_101361_link">TuDescuenton</a></th>


                                <td>2,400.00</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>


                                <td class="spacer">&nbsp;</td>
                            </tr>








                            <tr id="item-515701" class="edit-flyout  item-cat" category="101361" category="101361" company="company_0_101361"  >	

                                <th colspan="2"><span class="entry-edit"><a href="/entries/edit/515701" class="edit">Edit</a></span> <span class="color-bullet" style="color:#0066CC;">&bull;</span><a href="/entries/515701">Quincena TuDescuentón</a></th>


                                <td style="color:#0066CC;">2,400.00</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>



                                <td class="checkbox">

                                    <input id="active_checkbox_515701"type="checkbox" checked="checked" onclick="active_entry_toggle('/worksheet',515701);">
                                    <span id="active_loading_515701" style="display: none;"><img src="/images/loading_small.gif" alt="" style="vertical-align:middle;"></span>

                                </td>

                            </tr>













                        </tbody>



                        <tbody id="add-income">
                            <tr id="add-income-form">
                                <td colspan="12">
                                    <a href="/entries/new" class="add add-income" id="add-income-btn">Add income</a>
                                </td>
                            </tr>
                        </tbody>


                        <tbody id="expenses-header">
                            <tr>
                                <th colspan="2"><a href="#" id="expense-btn" onclick="action_toggle('expense-btn','expense'); toggle_worsheet_cookie(this,'wk', 'expense', 'active', '1'); return false;" class="active">Expenses</a></th>

                                <td>230.00</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>

                                <td>&nbsp;</td>
                            </tr>
                        </tbody>

                        <tbody id="expense" >


                            <tr class="category expand" id="category_101371">
                                <th colspan="2"><a href="#" class="expand" onclick="toggle_category(101371, 'expense'); toggle_worsheet_cookie(this,'wk', 'expense-101371', 'expand', '1'); return false" id="category_101371_link">Disfrute</a></th>


                                <td>230.00</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>



                                <td>&nbsp;</td>


                                <td class="spacer">&nbsp;</td>
                            </tr>








                            <tr id="item-515711" class="edit-flyout  item-cat" category="101371" category="101371" company="company_0_101371"  >	

                                <th colspan="2"><span class="entry-edit"><a href="/entries/edit/515711" class="edit">Edit</a></span> <span class="color-bullet" style="color:#0066CC;">&bull;</span><a href="/entries/515711">Cervezas Concierto</a></th>


                                <td style="color:#0066CC;">230.00</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>




                                <td>&nbsp;</td>



                                <td class="checkbox">

                                    <input id="active_checkbox_515711"type="checkbox" checked="checked" onclick="active_entry_toggle('/worksheet',515711);">
                                    <span id="active_loading_515711" style="display: none;"><img src="/images/loading_small.gif" alt="" style="vertical-align:middle;"></span>

                                </td>

                            </tr>












                        </tbody>



                        <tbody id="add-expense">
                            <tr>
                                <td colspan="12">
                                    <a href="/entries/new?type=expense" class="add add-expense" id="add-expense-btn">Add expense</a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

            </div></div></div>

    <div class="subnav-accounts">

        <div id="financial_accounts">
            <div class="display-group">
                <!--nil-->
                <span style="float:right;"><a href="http://margaro.pulseapp.com/financial_accounts" class="edit">Edit</a></span>
                <h3 style="margin-top:0;">Accounts</h3>
                <ul class="accounts">


                    <li class="">


                        <a href="#" onclick="active_account_toggle('/worksheet_new',26001, 'index'); Element.hide('fa-active_checkbox_26001'); return false;" title="Primary">

                            <span id="fa-active_loading_26001" style="display: none;"><img src="/images/loading_small.gif" alt="" style="vertical-align:middle;"></span>

                            <span id="fa-active_checkbox_26001" class="checkbox"><input type="checkbox" checked="checked"></span>

                            <span class="color-bullet" style="color:#0066CC;">&bull;</span>Primary</a>

                    </li>

                </ul>
                <p style="padding: 0 5px;"><a href="/financial_accounts/new" class="add">Add Account</a></p>
            </div>
        </div>


    </div>

</div>