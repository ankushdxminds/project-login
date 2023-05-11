@if(count($data)>0)

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>
                <div class="form-check">
                    <label class="form-check-label">
                        <input name="all_action"
                               class="all_action form-check-input"
                               type="checkbox"
                               onclick="check_action()"
                        >
                        <i class="input-helper"></i>
                    </label>
                </div>
            </th>
            <th>@lang('View.avatar')</th>
            <th>@lang('View.seller_name')</th>
            <th>@lang('View.email')</th>
            <th>@lang('View.phone_number')</th>
            <th>@lang('View.last_login')</th>
            <th>@lang('View.status')</th>
            <th>@lang('View.verify_status')</th>
            <th>@lang('View.action')</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data AS $key => $value)
            <tr>
                <td>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input name="action"
                                   class="action form-check-input"
                                   type="checkbox"
                                   value="{{ $value->id }}">
                            <i class="input-helper"></i>
                        </label>
                    </div>
                </td>
                <td class="py-1">
                    <img src="@if(!empty($value->avatar)){{config('constants.avatar_url').$value->avatar }} @else {{ config('constants.default_img_url') }} @endif"
                         alt="image"/>
                </td>
                <td>{{ $value->first_name.' '.$value->last_name }}</td>
                <td>{{ $value->email }}</td>
                <td>{{ $value->phone_number }}</td>
                <td>
                    @if(isset($value->login_ip) && !empty($value->login_ip))
                      IP :  {{ $value->login_ip }}
                    @endif
                    <br>
                        @if(isset($value->login_date) && !empty($value->login_date))
                        Date :  {{ set_date_time_format_timestamp($value->login_date) }}
                        @endif
                </td>
                <td>
                    @if($value->status == 1)
                        <label class="{{ create_custom_class('active') }}">@lang('View.active')</label>
                    @else
                        <label class="{{ create_custom_class('inactive') }}">@lang('View.inactive')</label>
                    @endif
                </td>
                <td>
                    @if($value->email_verified == 1)
                        <label class="{{ create_custom_class('active') }}">@lang('View.verified')</label>
                    @else
                        <label class="{{ create_custom_class('inactive') }}">@lang('View.not_verified')</label>
                    @endif
                </td>
                <td>
                    <a href="{{ config('routes.admin_user_edit').''.$value->id}}"

                    ><label class="{{ create_custom_class('edit') }}">
                            @lang('View.edit')
                        </label>
                    </a>
                    <a href="{{ config('routes.admin_user_password_change').''.$value->id}}"

                    ><label class="{{ create_custom_class('edit') }}">
                            @lang('View.password_change')
                        </label>
                    </a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@else

    <div class="not-found">
        @lang('View.not_found')
    </div>

@endif

